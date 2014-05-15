<?php

/* TeachingConfigBundle:Home:index.html.twig */
class __TwigTemplate_3f5626cae5b48a4bc86f81f69843b18b14d05b5f404cb087979884a59611b74a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TeachingConfigBundle::template.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TeachingConfigBundle::template.html.twig";
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
        echo "    ";
        // line 8
        echo "    <div class=\"row show-grid\">
        
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
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\">
                <label for=\"username\">Username:</label>
                <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" />

                <label for=\"password\">Password:</label>
                <input type=\"password\" id=\"password\" name=\"_password\" />

    ";
        // line 27
        echo "        <input type=\"hidden\" name=\"_target_path\" value=\"/validado\" />
   

                <button type=\"submit\">login</button>
            </form>
        </div>
    </div>
    
    ";
        // line 36
        echo "    <div class=\"row show-grid\">
        <div class=\"col-md-12\">
            <h3>Registrate</h3>
            ";
        // line 39
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
        </div>
    </div>
    
        
    ";
        // line 45
        echo "    ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session"), "flashbag"), "get", array(0 => "user_create"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 46
            echo "        
        <div class=\"row show-grid\" id=\"user_create\">
            <div class=\"col-md-12\">
                ";
            // line 49
            echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : $this->getContext($context, "message")), "html", null, true);
            echo "
            </div>
        </div>
        
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "
  
    
";
    }

    // line 60
    public function block_js($context, array $blocks = array())
    {
        echo "    
    ";
        // line 61
        $this->displayParentBlock("js", $context, $blocks);
        echo "    
    <script type=\"text/javascript\" src=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/functions_js.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "TeachingConfigBundle:Home:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 62,  129 => 61,  124 => 60,  117 => 54,  106 => 49,  101 => 46,  96 => 45,  88 => 39,  83 => 36,  73 => 27,  65 => 19,  60 => 17,  56 => 15,  50 => 12,  47 => 11,  45 => 10,  41 => 8,  39 => 7,  36 => 6,  30 => 3,);
    }
}
