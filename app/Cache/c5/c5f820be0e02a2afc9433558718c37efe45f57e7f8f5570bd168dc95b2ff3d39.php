<?php

/* daterange.report */
class __TwigTemplate_83c7150878177c4f0e42002681f2133414154cfb24e81eea30223317250508ee extends Twig_Template
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
        echo "   od: ";
        echo twig_escape_filter($this->env, ($context["dateFrom"] ?? null), "html", null, true);
        echo "   do: ";
        echo twig_escape_filter($this->env, ($context["dateTo"] ?? null), "html", null, true);
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
Raport Track  dla Device: ";
        // line 7
        echo twig_escape_filter($this->env, ($context["deviceId"] ?? null), "html", null, true);
        echo "   od: ";
        echo twig_escape_filter($this->env, ($context["dateFrom"] ?? null), "html", null, true);
        echo "   do: ";
        echo twig_escape_filter($this->env, ($context["dateTo"] ?? null), "html", null, true);
        echo "

";
    }

    public function getTemplateName()
    {
        return "daterange.report";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 7,  42 => 6,  33 => 4,  29 => 3,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("Raport Track  dla Device: {{ deviceId }}   od: {{ dateFrom }}   do: {{ dateTo }}

{% for key, value in tracks %}
    Type : {{ key }}
{% endfor %}

Raport Track  dla Device: {{ deviceId }}   od: {{ dateFrom }}   do: {{ dateTo }}

", "daterange.report", "/var/www/app/src/Reports/Sheets/Tracks/Reports/Documents/daterange.report");
    }
}
