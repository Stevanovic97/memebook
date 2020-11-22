<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Report meme</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'meme.report', 'method' => 'post', 'name' => 'report_meme_form')) }}
          <div class="form-group">
            {!! Form::Label('report', 'Reason for report:') !!}
            <select id="report" class="form-control" name="reason">
              @foreach($reasonsToReport as $key => $reason)
                <option value="{{ $key }}">{{ $reason }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            {!! Form::Label('exp', 'Explanation:') !!}
            <textarea id="exp" class="form-control" name="explanation" value="{{ old('explanation') }}" cols="4" rows="4"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Report</button>
          </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>