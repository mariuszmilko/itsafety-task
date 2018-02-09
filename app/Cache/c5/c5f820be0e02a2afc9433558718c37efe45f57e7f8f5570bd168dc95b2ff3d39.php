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

=========================================================================== 
";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["device"] ?? null));
        foreach ($context['_seq'] as $context["key"] => $context["tracks"]) {
            // line 5
            echo "     No.: ";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo "

  ";
            // line 7
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["tracks"]);
            foreach ($context['_seq'] as $context["key"] => $context["track"]) {
                // line 8
                echo " Typ: ";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo "
      ";
                // line 9
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["track"]);
                foreach ($context['_seq'] as $context["key"] => $context["parameter"]) {
                    // line 10
                    echo "Parametr: ";
                    echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                    echo "
            ";
                    // line 11
                    echo twig_var_dump($this->env, $context, $context["parameter"]);
                    echo "
--------------------------------------------------------------------------
      ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['parameter'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 14
                echo "
--------------------------------------------------------------------------      
  ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['track'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 17
            echo "========================================================================== 
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['tracks'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "

Raport Track  dla Device: ";
        // line 21
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
        return array (  86 => 21,  82 => 19,  75 => 17,  67 => 14,  58 => 11,  53 => 10,  49 => 9,  44 => 8,  40 => 7,  34 => 5,  30 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("Raport Track  dla Device: {{ deviceId }}   od: {{ dateFrom }}   do: {{ dateTo }}

=========================================================================== 
{% for key, tracks in device %}
     No.: {{ key }}

  {% for key, track in tracks %}
 Typ: {{ key }}
      {% for key, parameter in track %}
Parametr: {{ key }}
            {{dump(parameter)}}
--------------------------------------------------------------------------
      {% endfor %}

--------------------------------------------------------------------------      
  {% endfor %}
========================================================================== 
{% endfor %}


Raport Track  dla Device: {{ deviceId }}   od: {{ dateFrom }}   do: {{ dateTo }}

", "daterange.report", "/var/www/app/src/Reports/Sheets/Tracks/Reports/Documents/daterange.report");
    }
}
