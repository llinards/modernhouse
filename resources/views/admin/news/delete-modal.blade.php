<form action="/admin/news/{{ $news->id }}/delete" method="POST">
  @csrf
  @method('DELETE')
  <div class="modal fade" id="delete-news-modal-{{$news->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <h4>Vai tiešām vēlies dzēst?</h4>
          <p>Visas bildes un pielikumi saistīti ar šo aktualitāte arī tiks dzēstas.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Aizvērt</button>
          <button type="submit" class="btn btn-danger">Dzēst</button>
        </div>
      </div>
    </div>
  </div>
</form>
