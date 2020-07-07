@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <post-component inline-template>
                      <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>TITLE</th>
                            <th>BODY</th>
                            <th>&nbsp;</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="post in posts">
                            <th v-text="post.id"></th>
                            <td v-text="post.post_name"></td>
                            <td v-text="post.post_body"></td>
                            <td v-text="post.published"></td>
                          </tr>
                        </tbody>
                      </table>
                    </post-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
