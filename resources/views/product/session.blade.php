  <x-layouts>

      @foreach (auth()->user()->sessions()->orderBy('last_activity', 'desc')->get() as $session)
                    <div class="flex items-center justify-between p-3 bg-gray-800 rounded-lg border border-gray-700 mb-4">
                        <div class="flex items-center">
                            <i class="fas fa-{{$session->user_agent['is_desktop'] ? 'desktop' : 'mobile-alt'}} w-6 h-6 text-gray-200 mr-3"></i>
                            <div>
                                <div class="font-semibold text-white">
                                    {{$session->user_agent['platform']}} - {{$session->user_agent['browser']}}
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{$session->ip_address}} @if ($session->Is_This_device) <span class="text-green-500">This device</span> @endif
                                </div>
                                <div class="text-xs text-gray-500">Last Active {{$session->last_activity}}</div>
                            </div>
                        </div>
                    
                    </div>
                @endforeach


  </x-layouts>
