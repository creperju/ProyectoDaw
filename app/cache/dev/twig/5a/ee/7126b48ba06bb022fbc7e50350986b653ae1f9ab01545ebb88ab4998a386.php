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
        echo "    
    <div class=\"row show-grid\">
        
        ";
        // line 10
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 11
            echo "            <div class=\"col-md-3\">
                ";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "message"), "html", null, true);
            echo "
            </div>
        ";
        }
        // line 15
        echo "        
        <div class=\"col-md-9\">
            <form action=\"";
        // line 17
        echo $this->env->getExtension('routing')->getPath("form_check");
        echo "\" method=\"post\">
                <label for=\"username\">Username:</label>
                <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" />

                <label for=\"password\">Password:</label>
                <input type=\"password\" id=\"password\" name=\"_password\" />

    ";
        // line 29
        echo "
                <button type=\"submit\">login</button>
            </form>
        </div>
    </div>
    <div class=\"row show-grid\">
        <div class=\"col-md-12\">
            <h3>Registrate</h3>
            ";
        // line 37
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
        </div>
    </div>
    
    ";
        // line 41
        if (((isset($context["js_user"]) ? $context["js_user"] : $this->getContext($context, "js_user")) == true)) {
            // line 42
            echo "        <script type=\"javascript\">
            return alert(\"Usuario creado correctamente\");
        </script>
    ";
        }
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
        return array (  90 => 42,  88 => 41,  81 => 37,  71 => 29,  63 => 19,  58 => 17,  54 => 15,  48 => 12,  45 => 11,  43 => 10,  38 => 7,  35 => 6,  29 => 3,);
    }
}
