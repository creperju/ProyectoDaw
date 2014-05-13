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
        <div class=\"container-fluid\" style=\"height: 50px; background-color: gold;\">
            Cabecera
            <div>";
        // line 14
        $this->displayBlock('breadcrumps', $context, $blocks);
        echo "</div>
        </div>
        <div class=\"container\">
            ";
        // line 17
        $this->displayBlock('content', $context, $blocks);
        // line 20
        echo "        </div>
        
        <!-- Bootstrap Css -->
        ";
        // line 23
        $this->displayBlock('css', $context, $blocks);
        // line 27
        echo "        
        <!-- JQuery -->
        ";
        // line 29
        $this->displayBlock('js', $context, $blocks);
        // line 32
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

    // line 17
    public function block_content($context, array $blocks = array())
    {
        // line 18
        echo "            
            ";
    }

    // line 23
    public function block_css($context, array $blocks = array())
    {
        // line 24
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        ";
    }

    // line 29
    public function block_js($context, array $blocks = array())
    {
        // line 30
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/jquery-1.11.0.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "TeachingGeneralBundle::template.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  104 => 30,  101 => 29,  95 => 25,  90 => 24,  87 => 23,  82 => 18,  79 => 17,  74 => 14,  68 => 4,  63 => 32,  61 => 29,  57 => 27,  55 => 23,  50 => 20,  48 => 17,  42 => 14,  29 => 4,  24 => 1,);
    }
}
