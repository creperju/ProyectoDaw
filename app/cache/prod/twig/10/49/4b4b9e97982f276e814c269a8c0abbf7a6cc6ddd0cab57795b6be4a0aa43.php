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
            'content' => array($this, 'block_content'),
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
        // line 11
        $this->displayBlock('content', $context, $blocks);
        // line 14
        echo "        </div>
        
        <!-- Bootstrap Css -->
        <link href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        
    </body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "Teaching!";
    }

    // line 11
    public function block_content($context, array $blocks = array())
    {
        // line 12
        echo "            
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
        return array (  64 => 12,  61 => 11,  55 => 4,  47 => 18,  36 => 11,  26 => 4,  21 => 1,  71 => 29,  63 => 19,  58 => 17,  54 => 15,  48 => 12,  45 => 11,  43 => 17,  38 => 14,  35 => 6,  29 => 3,);
    }
}
