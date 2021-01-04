  <div class="radio-sellect">
      @foreach($doctortitle as $doctortitlekey)
      <div class="radio">
          <input type="radio" label="{{ Carbon\Carbon::parse($doctortitlekey->doctor_time)->format('H:i')}}" value="{{Carbon\Carbon::parse($doctortitlekey->doctor_time)->format('H:i')}}" name="doctor_time" id="doctor_time" checked />
      </div>
      @endforeach
  </div>
