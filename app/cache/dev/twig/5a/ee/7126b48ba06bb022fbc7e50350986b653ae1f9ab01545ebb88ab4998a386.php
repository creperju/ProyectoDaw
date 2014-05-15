<?php

/* TeachingGeneralBundle:Home:index.html.twig */
class __TwigTemplate_5aee7126b48ba06bb022fbc7e50350986b653ae1f9ab01545ebb88ab4998a386 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TeachingGeneralBundle::template.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        echo "Bienvenido a Teaching!";
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        // line 7
        echo "    <div class=\"container\">
        ";
        // line 9
        echo "        <div class=\"row show-grid\">

            ";
        // line 11
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 12
            echo "                <div class=\"col-md-3\">
                    ";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message"), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 16
        echo "
            <div class=\"col-md-12\">
                <form action=\"";
        // line 18
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\">
                    <label for=\"username\">Username:</label>
                    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 20
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" />

                    <label for=\"password\">Password:</label>
                    <input type=\"password\" id=\"password\" name=\"_password\" />

                    ";
        // line 26
        echo "                    <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('form')->renderer->renderCsrfToken("authenticate"), "html", null, true);
        echo "\" />

                    ";
        // line 29
        echo "                    <input type=\"hidden\" name=\"_target_path\" value=\"/validado\" />

                    <button type=\"submit\">login</button>
                </form>
            </div>
        </div>
    
        ";
        // line 37
        echo "        <div class=\"row show-grid\">
            <div class=\"col-md-12\">
                <h3>Registrate</h3>
                ";
        // line 40
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                    
                        <div style=\"float:left; clear: both;\">";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'label', array("label" => "Usuario"));
        echo "</div>
                        <div style=\"float:right;\">";
        // line 43
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "username"), 'widget');
        echo "</div>
                    
                        <div style=\"float:left; clear: both;\">";
        // line 45
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), 'label', array("label" => "Contraseña"));
        echo "</div>
                        <div style=\"float:right;\">";
        // line 46
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "password"), 'widget');
        echo "</div>
                    
                        <div style=\"float:left; clear: both;\">";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'label', array("label" => "Email"));
        echo "</div>
                        <div style=\"float:right;\">";
        // line 49
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email"), 'widget');
        echo "</div>
                    
                        <div style=\"float:left; clear: both;\">";
        // line 51
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name"), 'label', array("label" => "Nombre"));
        echo "</div>
                        <div style=\"float:right;\">";
        // line 52
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name"), 'widget');
        echo "</div>
                    
                        <div style=\"float:left; clear: both;\">";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname"), 'label', array("label" => "Apellidos"));
        echo "</div>
                        <div style=\"float:right;\">";
        // line 55
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "surname"), 'widget');
        echo "</div>
                        
                        <div style=\"float:left; clear: both;\">";
        // line 57
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "registrar"), 'widget');
        echo "</div>
                        
                ";
        // line 59
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
            </div>
        </div>
    
        
        ";
        // line 65
        echo "        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "user_create"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 66
            echo "
            <div class=\"row show-grid\" id=\"msg_flash\">
                <div class=\"col-md-12\">
                    ";
            // line 69
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message")), "html", null, true);
            echo "
                </div>
            </div>

        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "
  
   </div> 
";
    }

    public function getTemplateName()
    {
        return "TeachingGeneralBundle:Home:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  177 => 74,  166 => 69,  161 => 66,  156 => 65,  148 => 59,  143 => 57,  138 => 55,  134 => 54,  129 => 52,  125 => 51,  120 => 49,  116 => 48,  111 => 46,  107 => 45,  102 => 43,  98 => 42,  93 => 40,  88 => 37,  79 => 29,  73 => 26,  65 => 20,  60 => 18,  56 => 16,  50 => 13,  47 => 12,  45 => 11,  41 => 9,  38 => 7,  35 => 6,  29 => 3,);
    }
}
