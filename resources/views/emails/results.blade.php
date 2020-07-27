@component('mail::message')
# Dear Parent,

# Here are the results of your child,
# TERM {{ $results["resultslip"][0]->term->name  }}  {{ $results["resultslip"][0]->term->year  }}
# {{ $results["details"]->name }}  Adm No  {{ $results["details"]->admission_no }}  Form {{ $results["details"]->class_name  }}

@foreach($results["resultslip"] as $study)
# {{ $study->subject }} {{ $study->score }}
@endforeach

# Thanks,<br>
# Examination Office
# Murray Girls High School
@endcomponent
