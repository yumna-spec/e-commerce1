@props(['active'=>false])

<li class="nav-item">

        <a {{$attributes}} class= " {{$active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white-100 hover:text-white'}}" >{{ $slot }}

          </a>
        </li>



        


