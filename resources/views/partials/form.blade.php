<form method="get" action="{{url('weatherAction')}}">
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" id="location" name="location">
    </div>

    <div>
        <input type="checkbox" id="save" name="saveLocation">
        <label for="saveLocation">Save: </label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>