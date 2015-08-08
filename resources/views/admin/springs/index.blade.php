@extends('admin/admin')

@section('content')
<div class="row">
    <aside class="col-md-3">
        <h2>Admin sidebar #1</h2>
    </aside>
    <div class="col-md-6">
        <h1>Kaikki lähteet</h1>

        <h2>Järjestelmässä yhteensä: {{count($springs)}} lähdettä.  </h2>

        <a class="btn btn-default" href="create">Lisää uusi</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th><th>Name</th><th>Status</th><th>Visibility</th><th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
             @foreach ($springs as $spring)
                <tr>
                <td>{{ $spring->id }}</td>
                <td><a href="/lahteet/{{ $spring->id }}">{{ $spring->title }}</a></td>

                    @if ($spring->status == 'ei tietoa')
                    <td class="warning">{{ $spring->status}}</td>
                    @endif

                    @if ($spring->visibility == 1)
                    <td class="success">Näkyvissä / <a href="">Piilota</a></td>
                        @elseif($spring->visibility == 0)
                        <td class="active">Piilossa / <a href="">Näytä</a></td>

                    @endif
                    <td><a class="btn btn-primary">Muokkaa</a></td>
                </tr>
             @endforeach

            </tbody>


        </table>

    </div>

    <aside class="col-md-3">
        <h2>Admin sidebar #2</h2>

    </aside>

</div>

@endsection
