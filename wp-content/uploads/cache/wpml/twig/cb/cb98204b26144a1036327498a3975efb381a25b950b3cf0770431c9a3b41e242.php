<?php

/* save-notification.twig */
class __TwigTemplate_b16706aff2dcfadbbc1c7a56be8dc35eaf0332258a708b3139c3f4f35b333be1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<span class=\"js-wpml-ls-messages wpml-ls-messages\"></span><span class=\"spinner\"></span>
";
    }

    public function getTemplateName()
    {
        return "save-notification.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<span class=\"js-wpml-ls-messages wpml-ls-messages\"></span><span class=\"spinner\"></span>
", "save-notification.twig", "/Users/mcote/workspace/base_react_api/wp-content/plugins/sitepress-multilingual-cms/templates/language-switcher-admin-ui/save-notification.twig");
    }
}
