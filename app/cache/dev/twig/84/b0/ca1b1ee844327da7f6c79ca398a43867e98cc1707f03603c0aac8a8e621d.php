<?php

/* TeachingConfigBundle::template.html.twig */
class __TwigTemplate_84b0ca1b1ee844327da7f6c79ca398a43867e98cc1707f03603c0aac8a8e621d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
        
        <div class=\"container\">
            ";
        // line 14
        $this->displayBlock('content', $context, $blocks);
        // line 17
        echo "        </div>
        
        <!-- Bootstrap Css -->
        ";
        // line 20
        $this->displayBlock('css', $context, $blocks);
        // line 24
        echo "        
        <!-- JQuery -->
        ";
        // line 26
        $this->displayBlock('js', $context, $blocks);
        // line 29
        echo "    </body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "Teaching!";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "            
            ";
    }

    // line 20
    public function block_css($context, array $blocks = array())
    {
        // line 21
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        ";
    }

    // line 26
    public function block_js($context, array $blocks = array())
    {
        // line 27
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/jquery-1.11.0.js"), "html", null, true);
        echo "\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "TeachingConfigBundle::template.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  92 => 27,  89 => 26,  78 => 21,  75 => 20,  70 => 15,  67 => 14,  61 => 4,  54 => 26,  48 => 20,  43 => 17,  28 => 4,  23 => 1,  133 => 62,  129 => 61,  124 => 60,  117 => 54,  106 => 49,  101 => 46,  96 => 45,  88 => 39,  83 => 22,  73 => 27,  65 => 19,  60 => 17,  56 => 29,  50 => 24,  47 => 11,  45 => 10,  41 => 14,  39 => 7,  36 => 6,  30 => 3,);
    }
}
