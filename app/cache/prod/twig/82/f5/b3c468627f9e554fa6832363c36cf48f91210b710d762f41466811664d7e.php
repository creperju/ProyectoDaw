<?php

/* TeachingUserBundle::messages.html.twig */
class __TwigTemplate_82f5b3c468627f9e554fa6832363c36cf48f91210b710d762f41466811664d7e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TeachingGeneralBundle::template.html.twig");

        $this->blocks = array(
            'breadcrumps' => array($this, 'block_breadcrumps'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TeachingGeneralBundle::template.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_breadcrumps($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, (isset($context["controller"]) ? $context["controller"] : $this->getContext($context, "controller")), "html", null, true);
        echo ", <a href=\"";
        echo $this->env->getExtension('routing')->getPath("teaching_user_homepage");
        echo "\">Volver</a>";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container-fluid\">
<p></p>
        <div class=\"row\">

            <div class=\"col-md-2\" style=\"background-color: gray;\">
                <p>Redactar</p>
                <p>Recibidos</p>
                <p>Enviados</p>
            </div>

            <div class=\"col-md-10\">
                ";
        // line 18
        echo "                ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "message_send"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 19
            echo "
                    <div class=\"row show-grid\" id=\"msg_flash\">
                        <div class=\"col-md-9 col-md-offset-1\">
                            ";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message")), "html", null, true);
            echo "
                        </div>
                    </div>

                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "
                <div class=\"row\">

                    <div class=\"col-md-9 col-md-offset-1\">
                        <!-- Div contenido de mensajes -->
                        
                        <div class=\"row show-grid\">
                            <div class=\"col-md-12\">Mensajes recibidos</div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-12\">
                                ";
        // line 39
        if (((isset($context["messages_receibe"]) ? $context["messages_receibe"] : $this->getContext($context, "messages_receibe")) > 0)) {
            // line 40
            echo "                                    
                                    ";
            // line 41
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["messages_receibe"]) ? $context["messages_receibe"] : $this->getContext($context, "messages_receibe")));
            foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                // line 42
                echo "                                        <div class=\"col-md-4\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "fromUser"), "username"), "html", null, true);
                echo "</div>
                                        <div class=\"col-md-4\">";
                // line 43
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "subject"), "html", null, true);
                echo "</div>
                                        <div class=\"col-md-4\">";
                // line 44
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "date"), "d-m-Y, H:m"), "html", null, true);
                echo "</div>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "                                      <p></p>
                                ";
        } else {
            // line 48
            echo "                                    <p>No tienes mensajes.</p>
                                ";
        }
        // line 50
        echo "                            </div>
                        </div>
                        
                        
                        
                        <div class=\"row show-grid\">
                            <div class=\"col-md-12\">Mensajes enviados</div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-12\">
                                ";
        // line 61
        if (((isset($context["messages_send"]) ? $context["messages_send"] : $this->getContext($context, "messages_send")) > 0)) {
            // line 62
            echo "                                    ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["messages_send"]) ? $context["messages_send"] : $this->getContext($context, "messages_send")));
            foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
                // line 63
                echo "                                        <div class=\"col-md-4\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "toUser"), "username"), "html", null, true);
                echo "</div>
                                        <div class=\"col-md-4\">";
                // line 64
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "subject"), "html", null, true);
                echo "</div>
                                        <div class=\"col-md-4\">";
                // line 65
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["m"]) ? $context["m"] : $this->getContext($context, "m")), "date"), "d-m-Y, H:m"), "html", null, true);
                echo "</div>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 67
            echo "                                ";
        } else {
            // line 68
            echo "                                    <p>No tienes mensajes.</p>
                                ";
        }
        // line 70
        echo "                            </div>
                        </div>
                        <p/>
                        <div class=\"row show-grid\">
                            <div class=\"col-md-12\">Redactar</div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-md-12\">";
        // line 78
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "</div>
                        </div>

                     </div>
                </div>


            </div>

        </div>
        
    </div>
";
    }

    public function getTemplateName()
    {
        return "TeachingUserBundle::messages.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 78,  167 => 70,  163 => 68,  160 => 67,  152 => 65,  148 => 64,  143 => 63,  138 => 62,  136 => 61,  123 => 50,  119 => 48,  115 => 46,  107 => 44,  103 => 43,  98 => 42,  94 => 41,  91 => 40,  89 => 39,  75 => 27,  64 => 22,  59 => 19,  54 => 18,  41 => 6,  38 => 5,  29 => 3,);
    }
}
