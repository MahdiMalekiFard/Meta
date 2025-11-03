@props([
    'star'=>5,
])
<ul class="text-xl font-medium list-none mb-2">
    <li class="inline"><i @class(['mdi mdi-star','text-gray-400'=> $star < 1,'text-amber-400'=>$star>=1])></i></li>
    <li class="inline"><i @class(['mdi mdi-star','text-gray-400'=> $star < 2,'text-amber-400'=>$star>=2])></i></li>
    <li class="inline"><i @class(['mdi mdi-star','text-gray-400'=> $star < 3,'text-amber-400'=>$star>=3])></i></li>
    <li class="inline"><i @class(['mdi mdi-star','text-gray-400'=> $star < 4,'text-amber-400'=>$star>=4])></i></li>
    <li class="inline"><i @class(['mdi mdi-star','text-gray-400'=> $star < 5,'text-amber-400'=>$star>=5])></i></li>
</ul>