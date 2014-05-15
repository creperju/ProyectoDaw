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
            <h1>Teaching!</h1>
            <div>";
        // line 14
        if ((!(null === $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user")))) {
            echo "<a href=\"";
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">Cerrar sesión</a>";
        }
        echo "</div>
            <div>";
        // line 15
        $this->displayBlock('breadcrumps', $context, $blocks);
        echo "<br/>
            ";
        // line 16
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            echo "ROLE_USER";
        }
        // line 17
        echo "            ";
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN")) {
            echo "ROLE_ADMIN";
        }
        // line 18
        echo "            ";
        if ($this->env->getExtension('security')->isGranted("ROLE_TEACHER")) {
            echo "ROLE_TEACHER";
        }
        // line 19
        echo "                </div>
        </div>
            
        ";
        // line 22
        $this->displayBlock('content', $context, $blocks);
        // line 25
        echo "        
        <!-- Bootstrap Css -->
        ";
        // line 27
        $this->displayBlock('css', $context, $blocks);
        // line 31
        echo "        
        <!-- JQuery -->
        ";
        // line 33
        $this->displayBlock('js', $context, $blocks);
        // line 37
        echo "    </body>
</html>";
    }

    // line 4
    public function block_title($context, array $blocks = array())
    {
        echo "Teaching!";
    }

    // line 15
    public function block_breadcrumps($context, array $blocks = array())
    {
    }

    // line 22
    public function block_content($context, array $blocks = array())
    {
        // line 23
        echo "
        ";
    }

    // line 27
    public function block_css($context, array $blocks = array())
    {
        // line 28
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
            <link href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/css/main.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" />
        ";
    }

    // line 33
    public function block_js($context, array $blocks = array())
    {
        // line 34
        echo "            <script type=\"text/javascript\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/jquery-1.11.0.js"), "html", null, true);
        echo "\"></script>
            <script type=\"text/javascript\" src=\"";
        // line 35
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
        return array (  133 => 35,  128 => 34,  125 => 33,  119 => 29,  114 => 28,  111 => 27,  106 => 23,  103 => 22,  98 => 15,  92 => 4,  87 => 37,  85 => 33,  81 => 31,  79 => 27,  75 => 25,  73 => 22,  68 => 19,  63 => 18,  58 => 17,  54 => 16,  50 => 15,  42 => 14,  29 => 4,  24 => 1,);
    }
}
