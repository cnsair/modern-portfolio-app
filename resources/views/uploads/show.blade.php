<style>
    .header-space{
        margin-left: 10em;
    }

    .one-line{
        display: block;
    }

    a.pass:hover{
        color: #f8e694;
    }

    .space{
        padding: 0px 20px 0px 20px;
    }

    .sp-margin{
        margin-bottom: 40px;
    }

    b.f-color{
        /* color: green !important; */
        color:#f8e694;
        /* color: #8af742 !important; */
    }
    .green{
        color: greenyellow;
    }
    a.green:hover{
        color: #8af742;
    }

    .oneline{
        display: inline-flex !important;
    }

    .padn{
        padding: 1%;
    }
    .pic{
        width: 120px;
        border: 1px solid grey;
        padding: 2px;
        border-radius: 5px;;
    }
</style>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- p-6 sm:p-8 -->
                <div class="oneline padn text-gray-900 dark:text-gray-100">
                    <div class="max-w-xl f-color">
                        <ul> <h2>SUMMARY</h2>
                            @forelse ($summary_section as $summary)
                                <div style="padding: 2%">
                                    <li>
                                        <b class="f-color">Name:</b>
                                        <h3>{{ $summary->myname }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Position:</b>
                                        <h3>{{ $summary->position }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Biography:</b>
                                        <h3>{{ $summary->biography }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Address:</b>
                                        <h3>{{ $summary->address }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Phone:</b>
                                        <h3>{{ $summary->phone }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Email:</b>
                                        <h3>{{ $summary->email }}</h3>
                                    </li>  
                            
                                    <div style="margin-top: 1%">
                                        <div class="oneline">
                                            <a class="green" href="{{ route('summary.edit', ['summary' => $summary->id]) }}">Edit </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Nothing to display</p>
                            @endforelse
                        </ul>

                        <!-- =====================================
                                    Education section
                        =========================================-->
                        <ul> <h2>EDUCATION</h2>
                            @forelse ($education_section as $education)
                                <div style="padding: 2%">
                                    <li>
                                        <b class="f-color">Status:</b>
                                        <h3>
                                            @if ( $education->status == 1 )
                                                Attending College 
                                            @else
                                                Graduated College
                                            @endif
                                        </h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Date-From - Date-To:</b>
                                        <h3>{{ $education->date }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Course:</b>
                                        <h3 name="name">{{ $education->course }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">School:</b>
                                        <h3 name="name">{{ $education->school }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Activities:</b>
                                        <h3 name="name">
                                            @php
                                                $act = $education->activity;
                                                $explode = explode('|', $act);
                                            @endphp

                                            @foreach ( $explode as $exp )
                                                <li>&rsaquo; {{ $exp }}</li>
                                            @endforeach
                                        </h3>
                                    </li>  
                            
                                    <div style="margin-top: 1%">
                                        <div class="oneline">
                                            <a class="green" href="{{ route('education.edit', ['education' => $education->id]) }}">Edit </a>
                                        </div>
    
                                        <div class="oneline">
                                            <form action="{{ route('education.destroy', ['education' => $education->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <x-danger-button onclick="return confirm('Are you sure you want to delete this record?');" class="ms-3">
                                                    {{ __('Delete') }}
                                                </x-danger-button>

                                                @if (session('status') === 'education-deleted')
                                                    <p
                                                        x-data="{ show: true }"
                                                        x-show="show"
                                                        x-transition
                                                        x-init="setTimeout(() => show = false, 2000)"
                                                        class="text-sm text-gray-600 dark:text-gray-400"
                                                    >{{ __('Education Deleted.') }}</p>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Nothing to display</p>
                            @endforelse
                        </ul>

                        

                        <!-- =====================================
                                    Resume section
                        =========================================-->
                        <ul> <h2>Resume</h2>
                            @forelse ($resume_section as $resume)
                                <div style="padding: 2%">
                                    <li>
                                        <b class="f-color">Title:</b>
                                        <h3>{{ $resume->title }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">File:</b>
                                        @php
                                            $file = $resume->file;
                                            $file_url = asset('storage/' . $file);
                                            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                                            //$file_ext = $file->extension();
                                        @endphp

                                        @if ( $file_ext == 'pdf' || $file_ext == 'docx' )
                                            <a href="{{ $file_url }}" download >Download PDF</a>
                                        @endif
                                    </li> 
                                    
                                    <div style="margin-top: 1%">
                                        <div class="oneline">
                                            <a class="green" href="{{ route('resume.edit', ['resume' => $resume->id]) }}">Edit </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Nothing to display</p>
                            @endforelse
                        </ul>
                                
                    </div>
                </div>

                <div class="oneline padn text-gray-900 dark:text-gray-100">
                    <div class="max-w-xl f-color">
                        <ul> <h2>EXPERIENCE</h2>
                            @forelse ($experience_section as $experience)
                                <div style="padding: 2%">
                                    
                                    <li>
                                        <b class="f-color">Role:</b>
                                        <h3 name="name">{{ $experience->role }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Date-From - Date-To:</b>
                                        <h3>{{ $experience->date }}</h3>
                                    </li>
                                    <li>
                                        <b class="f-color">Company & Location:</b>
                                        @php
                                            $comp = $experience->location;
                                            $explode = explode('|', $comp);
                                        @endphp

                                        @foreach ( $explode as $comp )
                                            <h3 name="name">{{ $comp }}</h3>
                                        @endforeach
                                    </li>
                                    <li>
                                        <b class="f-color">Activities:</b>
                                        <h3 name="name">
                                            @php
                                                $act = $experience->activity;
                                                $explode = explode('|', $act);
                                            @endphp

                                            @foreach ( $explode as $exp )
                                                <li>&rsaquo; {{ $exp }}</li>
                                            @endforeach
                                        </h3>
                                    </li>  
                            
                                    <div style="margin-top: 1%">
                                        <div class="oneline">
                                            <a class="green" href="{{ route('experience.edit', ['experience' => $experience->id]) }}">Edit </a>
                                        </div>
    
                                        <div class="oneline">
                                            <form action="{{ route('experience.destroy', ['experience' => $experience->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <!-- <button type="submit" class="green">Delete</button> -->
                                                <x-danger-button onclick="return confirm('Are you sure you want to delete this record?');" class="ms-3">
                                                    {{ __('Delete') }}
                                                </x-danger-button>

                                                @if (session('status') === 'experience-deleted')
                                                    <p
                                                        x-data="{ show: true }"
                                                        x-show="show"
                                                        x-transition
                                                        x-init="setTimeout(() => show = false, 2000)"
                                                        class="text-sm text-gray-600 dark:text-gray-400"
                                                    >{{ __('Experience Deleted.') }}</p>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Nothing to display</p>
                            @endforelse
                        </ul>
                                
                        <ul> <h2>PORTFOLIO</h2>
                            @forelse ($portfolio_section as $portfolio)
                                <div style="padding: 2%">
                                    
                                    <li>
                                        <b class="f-color">Project Name:</b>
                                        <h3 name="name">{{ $portfolio->name }}</h3>
                                    </li>
                                    @if ( $portfolio->web_address == !null )
                                        <li>
                                            <b class="f-color">Web Address:</b>
                                            <h3>{{ $portfolio->web_address }}</h3>
                                        </li>
                                    @endif
                                    @if ( $portfolio->description == !null )
                                        <li>
                                            <b class="f-color">Description:</b>
                                            <h3 name="name">{{ $portfolio->description }}</h3>
                                        </li>
                                    @endif
                                    <li>
                                        <b class="f-color">Preview:</b>
                                        @php
                                            $file = $portfolio->file;
                                            $file_url = asset('storage/' . $file);
                                            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
                                        @endphp

                                        @if ( $file_ext == 'pdf' )
                                            <a href="{{ $file_url }}" download >Download PDF</a>
                                        @else
                                            <img class="pic" src="{{ $file_url }}" alt="{{ $portfolio->name }}" />
                                        @endif
                                    </li>
                            
                                    <div style="margin-top: 1%">
                                        <div class="oneline">
                                            <a class="green" href="{{ route('portfolio.edit', ['portfolio' => $portfolio->id]) }}">Edit </a>
                                        </div>
    
                                    </div>
                                </div>
                            @empty
                                <p>Nothing to display</p>
                            @endforelse
                        </ul>
                                
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>