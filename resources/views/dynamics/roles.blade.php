"children":[
@foreach($childs as $child)
{
	"id": {{ $child->id }},
	"text": "{{ $child->name }}",
	@if(count($child->children ?? array()))
		@include('dynamics.roles', ['childs' => $child->children])
	@endif
},
@endforeach
]