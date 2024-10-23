<tr>
    <td class= "jours"
        rowspan ="6"><code>j<br/>o<br/>u
      <br/>r<br/>s</code></td>
    <td class="lundi"> Lundi </td>
    {{-- Séance Lundi S1 --}}
    @foreach ($teacherEmploi as $emploit)
    @if (($emploit->jour == 'Lundi' && $emploit->heure == '08:30-10:00'))
      <td class="">bb</td>
    @elseif (!empty($emploit->jour == 'Lundi' && $emploit->heure == '08:30-10:00'))
      <td class="silver">aa</td>
    @endif

    {{-- Séance Lundi S2 --}}
    @if (($emploit->jour == 'Lundi' && $emploit->heure == '10:05-11:35'))
      <td>
        <p>classe: {{$emploit->classe_id}}</p>
        <p>matiere: {{$emploit->matiere_id}}</p>
        <p>salle: {{$emploit->salle_id}}</p>
      </td>
    @elseif (!empty($emploit->jour == 'Lundi' && $emploit->heure == '10:05-11:35'))
      <td class="silver"></td>
    @endif

    {{-- Séance Lundi S3 --}}
    @if (($emploit->jour == 'Lundi' && $emploit->heure == '11:40-13:10'))
      <td>
        <p>classe: {{$emploit->classe_id}}</p>
        <p>matiere: {{$emploit->matiere_id}}</p>
        <p>salle: {{$emploit->salle_id}}</p>
      </td>
    @elseif (!empty($emploit->jour == 'Lundi' && $emploit->heure == '11:40-13:10'))
      <td class="silver"></td>
    @endif

    {{-- Séance Lundi S4 --}}
    @if (($emploit->jour == 'Lundi' && $emploit->heure == '13:15-14:45'))
      <td>
        <p>classe: {{$emploit->classe_id}}</p>
        <p>matiere: {{$emploit->matiere_id}}</p>
        <p>salle: {{$emploit->salle_id}}</p>
      </td>
    @elseif (!empty($emploit->jour == 'Lundi' && $emploit->heure == '13:15-14:45'))
      <td class="silver"></td>
    @endif

    {{-- Séance Lundi S5 --}}
    @if (($emploit->jour == 'Lundi' && $emploit->heure == '14:50-16:20'))
      <td>
        <p>classe: {{$emploit->classe_id}}</p>
        <p>matiere: {{$emploit->matiere_id}}</p>
        <p>salle: {{$emploit->salle_id}}</p>
      </td>
    @elseif (!empty($emploit->jour == 'Lundi' && $emploit->heure == '13:15-14:45'))
      <td class="silver"></td>
    @endif

    {{-- Séance Lundi S6 --}}
    @if (($emploit->jour == 'Lundi' && $emploit->heure == '16:25:17:55'))
      <td>
        <p>classe: {{$emploit->classe_id}}</p>
        <p>matiere: {{$emploit->matiere_id}}</p>
        <p>salle: {{$emploit->salle_id}}</p>
      </td>
      @elseif (!empty($emploit->jour == 'Lundi' && $emploit->heure == '13:15-14:45'))
      <td class="silver"></td>
    @endif
    
    @endforeach
  </tr>