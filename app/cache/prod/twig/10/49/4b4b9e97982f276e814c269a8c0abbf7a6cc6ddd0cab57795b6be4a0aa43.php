<?php

/* TeachingGeneralBundle::template.html.twig */
class __TwigTemplate_10494b4b9e97982f276e814c269a8c0abbf7a6cc6ddd0cab57795b6be4a0aa43 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'breadcrumps' => array($this, 'block_breadcrumps'),
            'content' => array($this, 'block_content'),
            'css' => array($this, 'block_css'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <title>";
        // line 4
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <!-- Para dispositivos móviles -->
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        
        
        
    </head>
    <body>
        <div class=\"container-fluid\" style=\"height: 100px; background-color: gold;\">
            Cabecera
            <div>";
        // line 14
        if ((!(null === $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")))) {
            echo "<a href=\"";
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">Cerrar sesión</a>";
        }
        echo "</div><div>";
        $this->displayBlock('breadcrumps', $context, $blocks);
        echo "<br/>
            ";
        // line 15
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            echo "ROLE_USER";
        }
        // line 16
        echo "            ";
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            echo "ROLE_ADMIN";
        }
        // line 17
        echo "            ";
        if ($this->env->getExtension('security')->isGranted("ROLE_TEACHER")) {
            echo "ROLE_TEACHER";
        }
        // line 18
        echo "                </div>
        </div>
            
        ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 24
        echo "        
        <!-- Bootstrap Css -->
        ";
        // line 26
        $this->displayBlock('css', $context, $blocks);
        // line 30
        echo "        
        <!-- JQuery -->
        ";
        // line 32
        $this->displayBlock('js', $context, $blocks);
        // line 36
        echo "    </body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "Teaching!";
    }

    // line 14
    public function block_breadcrumps($context, array $blocks = array())
    {
    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        // line 22
        echo "
        ";
    }

    // line 26
    public function block_css($context, array $blocks = array())
    {
        // line 27
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        ";
    }

    // line 32
    public function block_js($context, array $blocks = array())
    {
        // line 33
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/jquery-1.11.0.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/functions_js.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "TeachingGeneralBundle::template.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  131 => 34,  126 => 33,  123 => 32,  117 => 28,  112 => 27,  109 => 26,  104 => 22,  101 => 21,  96 => 14,  90 => 4,  85 => 36,  83 => 32,  79 => 30,  77 => 26,  73 => 24,  71 => 21,  66 => 18,  61 => 17,  56 => 16,  52 => 15,  42 => 14,  24 => 1,  121 => 54,  110 => 49,  105 => 46,  100 => 45,  92 => 39,  87 => 36,  78 => 28,  72 => 25,  64 => 19,  59 => 17,  55 => 15,  49 => 12,  46 => 11,  44 => 10,  40 => 8,  38 => 7,  35 => 6,  29 => 4,);
    }
}
