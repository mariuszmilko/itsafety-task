<?php

/* day.report */
class __TwigTemplate_50d2879e2ef7131d1475836ae80e2b32eb22cf33de77fd49678a61b127523748 extends Twig_Template
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
        echo "Raport Track  dla Device: ";
        echo twig_escape_filter($this->env, ($context["deviceId"] ?? null), "html", null, true);
        echo "   dzień: ";
        echo twig_escape_filter($this->env, ($context["day"] ?? null), "html", null, true);
        echo "

";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tracks"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["value"]) {
            // line 4
            echo "    Type : ";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "
";
        // line 7
        echo twig_var_dump($this->env, $context, ($context["tracks"] ?? null));
        echo "
Raport Track  dla Device: ";
        // line 8
        echo twig_escape_filter($this->env, ($context["deviceId"] ?? null), "html", null, true);
        echo "   dzień: ";
        echo twig_escape_filter($this->env, ($context["day"] ?? null), "html", null, true);
        echo "
";
    }

    public function getTemplateName()
    {
        return "day.report";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 8,  43 => 7,  40 => 6,  31 => 4,  27 => 3,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("Raport Track  dla Device: {{ deviceId }}   dzień: {{ day }}

{% for key, value in tracks %}
    Type : {{ key }}
{% endfor %}

{{dump(tracks)}}
Raport Track  dla Device: {{ deviceId }}   dzień: {{ day }}
", "day.report", "/var/www/app/src/Reports/Sheets/Tracks/Reports/Documents/day.report");
    }
}
