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
            'js' => array($this, 'block_js'),
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
        // line 43
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "user_create"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 44
            echo "        
        <div class=\"row show-grid\" id=\"user_create\">
            <div class=\"col-md-12\">
                ";
            // line 47
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message")), "html", null, true);
            echo "
            </div>
        </div>
        
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "
  
    
";
    }

    // line 57
    public function block_js($context, array $blocks = array())
    {
        // line 58
        echo "    
    ";
        // line 59
        $this->displayParentBlock("js", $context, $blocks);
        echo "    
    <script type=\"text/javascript\" src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/functions_js.js"), "html", null, true);
        echo "\"></script>
    
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
        return array (  128 => 60,  124 => 59,  121 => 58,  118 => 57,  111 => 52,  100 => 47,  95 => 44,  90 => 43,  82 => 37,  72 => 29,  64 => 19,  59 => 17,  55 => 15,  49 => 12,  46 => 11,  44 => 10,  39 => 7,  36 => 6,  30 => 3,);
    }
}
