<x-app-layout>
    <x-slot name="header">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Shopify Code Challenge - Thiago Paiva de Oliveira Alves</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('images.create') }}"> Insert new images</a>
            </div>
        </div>
    </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 pull-right" style="margin-bottom: 10px;">
                            <form action="{{ route('images.index') }}" method="get">
                                <input style="margin-right: 5px;"class="col-lg-9" type="text" name="search" class="form-control" placeholder="Search">
                                <input type="submit" class="col-lg-2 btn btn-primary pull-right" value="Search">
                            </form>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Keywords</th>
                            <th>Details</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($images as $img)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><img src="image/{{ $img->image }}" width="100px"></td>
                            <td>{{ $img->name }}</td>
                            <td>{{ $img->price }}</td>
                            <td>{{ $img->keywords }}</td>
                            <td>{{ $img->detail }}</td>
                            <td>
                                <form action="{{ route('images.destroy',$img->id) }}" method="POST">

                                    <a class="btn btn-info" href="{{ route('images.show',$img->id) }}">Show</a>

                                    <a class="btn btn-primary" href="{{ route('images.edit',$img->id) }}">Edit</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $images->links() !!}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

