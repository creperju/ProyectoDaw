<?php

/* TeachingUserBundle::index.html.twig */
class __TwigTemplate_acca7494082e1c2458e4651c6c2307e6b54a1c05013c0a657c920bdf6fccc3fd extends Twig_Template
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
        echo "Bienvenido ";
        echo twig_escape_filter($this->env, (isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"container\">
        <div class=\"row show-grid\">
            <div class=\"col-md-5\" onclick=\"window.location.assign('";
        // line 8
        echo $this->env->getExtension('routing')->getPath("teaching_user_messages");
        echo "')\">Mensajes</div>
            <div class=\"col-md-7\">Configuración</div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "TeachingUserBundle::index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 8,  39 => 6,  36 => 5,  29 => 3,);
    }
}
