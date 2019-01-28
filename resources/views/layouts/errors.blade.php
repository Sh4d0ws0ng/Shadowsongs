@if(count($errors))

  <div class="errors col s12">
    <ul>
      @foreach($errors->all() as $error)

      <li>{{ $error }}</li>

      @endforeach
    </ul>
  </div>

@endif
