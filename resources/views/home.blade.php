<!DOCTYPE html>
<html lang="en">
<head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Portfolio Management Dashboard</title>
              <script src="https://cdn.tailwindcss.com"></script>
              <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
              <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
              <div x-data="{ activeTab: 'projects', showModal: false, modalType: '', currentItem: null }">
                            <!-- Header -->
                            <header class="bg-gradient-to-r from-blue-800 to-indigo-900 text-white p-6 shadow-lg">
                                          <div class="container mx-auto flex justify-between items-center">
                                                        <h1 class="text-3xl font-bold">Portfolio Dashboard</h1>
                                                        <div>
                                                                      @if(isset($users) && count($users) > 0)
                                                                                    <span class="font-semibold">{{ $users[0]->first_name }} {{ $users[0]->last_name }}</span>
                                                                      @endif
                                                        </div>
                                          </div>
                            </header>

                            <!-- Navigation -->
                            <nav class="bg-white shadow-md">
                                          <div class="container mx-auto flex">
                                                        <button @click="activeTab = 'projects'" :class="{'bg-blue-600 text-white': activeTab === 'projects', 'bg-white text-gray-700 hover:bg-gray-100': activeTab !== 'projects'}" class="py-4 px-8 font-medium transition duration-200">
                                                                      <i class="fas fa-project-diagram mr-2"></i>Projects
                                                        </button>
                                                        <button @click="activeTab = 'tools'" :class="{'bg-blue-600 text-white': activeTab === 'tools', 'bg-white text-gray-700 hover:bg-gray-100': activeTab !== 'tools'}" class="py-4 px-8 font-medium transition duration-200">
                                                                      <i class="fas fa-tools mr-2"></i>Tools
                                                        </button>
                                                        <button @click="activeTab = 'profile'" :class="{'bg-blue-600 text-white': activeTab === 'profile', 'bg-white text-gray-700 hover:bg-gray-100': activeTab !== 'profile'}" class="py-4 px-8 font-medium transition duration-200">
                                                                      <i class="fas fa-user mr-2"></i>Profile
                                                        </button>
                                                        <button @click="activeTab = 'messages'" :class="{'bg-blue-600 text-white': activeTab === 'messages', 'bg-white text-gray-700 hover:bg-gray-100': activeTab !== 'messages'}" class="py-4 px-8 font-medium transition duration-200">
                                                                      <i class="fas fa-envelope mr-2"></i>Messages
                                                                      <span class="bg-red-500 text-white rounded-full px-2 py-1 text-xs ml-1">{{ count($messages) }}</span>
                                                        </button>
                                          </div>
                            </nav>

                            <!-- Status and Error Messages -->
                            <div class="container mx-auto px-4 mt-4">
                                          @if(session('success'))
                                                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-md flex items-center justify-between" x-data="{ show: true }" x-show="show">
                                                                      <div class="flex items-center">
                                                                                    <i class="fas fa-check-circle mr-2"></i>
                                                                                    <span>{{ session('success') }}</span>
                                                                      </div>
                                                                      <button @click="show = false" class="text-green-700 hover:text-green-900">
                                                                                    <i class="fas fa-times"></i>
                                                                      </button>
                                                        </div>
                                          @endif

                                          @if(session('error'))
                                                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-md flex items-center justify-between" x-data="{ show: true }" x-show="show">
                                                                      <div class="flex items-center">
                                                                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                                                                    <span>{{ session('error') }}</span>
                                                                      </div>
                                                                      <button @click="show = false" class="text-red-700 hover:text-red-900">
                                                                                    <i class="fas fa-times"></i>
                                                                      </button>
                                                        </div>
                                          @endif

                                          @if($errors->any())
                                                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded shadow-md" x-data="{ show: true }" x-show="show">
                                                                      <div class="flex items-center justify-between">
                                                                                    <div class="flex items-center">
                                                                                                  <i class="fas fa-exclamation-triangle mr-2"></i>
                                                                                                  <span class="font-medium">Please fix the following errors:</span>
                                                                                    </div>
                                                                                    <button @click="show = false" class="text-yellow-700 hover:text-yellow-900">
                                                                                                  <i class="fas fa-times"></i>
                                                                                    </button>
                                                                      </div>
                                                                      <ul class="mt-2 list-disc list-inside">
                                                                                    @foreach($errors->all() as $error)
                                                                                                  <li>{{ $error }}</li>
                                                                                    @endforeach
                                                                      </ul>
                                                        </div>
                                          @endif
                            </div>

                            <!-- Main Content -->
                            <main class="container mx-auto my-8 px-4">
                                          <!-- Projects Tab -->
                                          <div x-show="activeTab === 'projects'" class="space-y-8">
                                                        <div class="flex justify-between items-center">
                                                                      <h2 class="text-2xl font-bold text-gray-800">Projects</h2>
                                                                      <button @click="modalType = 'project-add'; showModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                                                                    <i class="fas fa-plus mr-2"></i> Add Project
                                                                      </button>
                                                        </div>
                                                        
                                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                                                      @forelse($projects as $project)
                                                                                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                                                                                                  <div class="h-48 overflow-hidden">
                                                                                                                @if($project->image_url)
                                                                                                                              <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                                                                                                @else
                                                                                                                              <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                                                                                                                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                                                                                                                              </div>
                                                                                                                @endif
                                                                                                  </div>
                                                                                                  <div class="p-6">
                                                                                                                <div class="flex justify-between items-center mb-3">
                                                                                                                              <h3 class="font-bold text-xl text-gray-800">{{ $project->title }}</h3>
                                                                                                                              <span class="text-xs font-semibold bg-indigo-100 text-indigo-800 px-2 py-1 rounded-full">{{ $project->type }}</span>
                                                                                                                </div>
                                                                                                                <p class="text-gray-600 mb-4">{{ Str::limit($project->description, 100) }}</p>
                                                                                                                
                                                                                                                <div class="flex flex-wrap gap-2 mb-4">
                                                                                                                              @foreach($project->tools as $tool)
                                                                                                                                            <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded">{{ $tool->name }}</span>
                                                                                                                              @endforeach
                                                                                                                </div>
                                                                                                                
                                                                                                                <div class="flex justify-between items-center mt-4">
                                                                                                                           
                                                                                                                              <div class="space-x-2">
                                                                                                                                            <button @click="currentItem = {{ $project->id }}; modalType = 'project-edit'; showModal = true" class="text-yellow-600 hover:text-yellow-800">
                                                                                                                                                          <i class="fas fa-edit"></i>
                                                                                                                                            </button>
                                                                                                                                            <form :action="'{{ route('projects.destroy', '') }}/' + {{ $project->id }}" method="POST" class="inline">
                                                                                                                                                          @csrf
                                                                                                                                                          @method('DELETE')
                                                                                                                                                          <button type="submit" class="text-red-600 hover:text-red-800">
                                                                                                                                                                        <i class="fas fa-trash"></i>
                                                                                                                                                          </button>
                                                                                                                                            </form>
                                                                                                                              </div>
                                                                                                                </div>
                                                                                                  </div>
                                                                                    </div>
                                                                      @empty
                                                                                    <div class="col-span-3 text-center py-10">
                                                                                                  <i class="fas fa-folder-open text-5xl text-gray-300 mb-3"></i>
                                                                                                  <p class="text-gray-500">No projects found. Add your first project!</p>
                                                                                    </div>
                                                                      @endforelse
                                                        </div>
                                          </div>

                                          <!-- Tools Tab -->
                                          <div x-show="activeTab === 'tools'" class="space-y-8">
                                                        <div class="flex justify-between items-center">
                                                                      <h2 class="text-2xl font-bold text-gray-800">Tools</h2>
                                                                      <button @click="modalType = 'tool-add'; showModal = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                                                                                    <i class="fas fa-plus mr-2"></i> Add Tool
                                                                      </button>
                                                        </div>
                                                        
                                                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                                                                      @forelse($tools as $tool)
                                                                                    <div class="bg-white rounded-lg shadow-md p-4 text-center relative group">
                                                                                                  <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                                                                                <button @click="currentItem = {{ $tool->id }}; modalType = 'tool-edit'; showModal = true" class="text-yellow-600 hover:text-yellow-800 mr-1">
                                                                                                                              <i class="fas fa-edit"></i>
                                                                                                                </button>
                                                                                                                <form :action="'{{ route('tools.destroy', '') }}/' + {{ $tool->id }}" method="POST" class="inline">
                                                                                                                              @csrf
                                                                                                                              @method('DELETE')
                                                                                                                              <button type="submit" class="text-red-600 hover:text-red-800">
                                                                                                                                            <i class="fas fa-trash"></i>
                                                                                                                              </button>
                                                                                                                </form>
                                                                                                  </div>
                                                                                                  <div class="h-16 w-16 mx-auto mb-3">
                                                                                                                @if($tool->image_url)
                                                                                                                              <img src="{{ $tool->image_url }}" alt="{{ $tool->name }}" class="h-full w-full object-contain">
                                                                                                                @else
                                                                                                                              <div class="w-full h-full bg-gray-200 rounded-full flex items-center justify-center">
                                                                                                                                            <i class="fas fa-wrench text-gray-400"></i>
                                                                                                                              </div>
                                                                                                                @endif
                                                                                                  </div>
                                                                                                  <h3 class="font-medium text-gray-800">{{ $tool->name }}</h3>
                                                                                                  <p class="text-xs text-gray-500 mt-1">{{ $tool->projects->count() }} projects</p>
                                                                                    </div>
                                                                      @empty
                                                                                    <div class="col-span-full text-center py-10">
                                                                                                  <i class="fas fa-tools text-5xl text-gray-300 mb-3"></i>
                                                                                                  <p class="text-gray-500">No tools found. Add your first tool!</p>
                                                                                    </div>
                                                                      @endforelse
                                                        </div>
                                          </div>

                                          <!-- Profile Tab -->
                                          <div x-show="activeTab === 'profile'" class="space-y-8">
                                                        <h2 class="text-2xl font-bold text-gray-800">Profile</h2>
                                                        
                                                        @if(isset($users) && count($users) > 0)
                                                                      @php $user = $users[0]; @endphp
                                                                      <div class="bg-white shadow-md rounded-lg p-8">
                                                                                    <div class="flex flex-col md:flex-row gap-8">
                                                                                                  <div class="md:w-1/3 flex flex-col items-center">
                                                                                                                <div class="w-40 h-40 rounded-full overflow-hidden mb-4 bg-gray-200">
                                                                                                                              @if($user->profile_image)
                                                                                                                                            <img src="{{ $user->profile_image }}" alt="{{ $user->first_name }}" class="h-full w-full object-cover">
                                                                                                                              @else
                                                                                                                                            <div class="w-full h-full flex items-center justify-center">
                                                                                                                                                          <i class="fas fa-user text-gray-400 text-6xl"></i>
                                                                                                                                            </div>
                                                                                                                              @endif
                                                                                                                </div>
                                                                                                                <h3 class="text-xl font-semibold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</h3>
                                                                                                                <p class="text-gray-600">{{ $user->email }}</p>
                                                                                                  </div>
                                                                                                  
                                                                                                  <div class="md:w-2/3">
                                                                                                                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                                                                                                                              @csrf
                                                                                                                              @method('PUT')
                                                                                                                              
                                                                                                                              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                                                                                                            <div>
                                                                                                                                                          <label class="block text-gray-700 text-sm font-medium mb-2">First Name</label>
                                                                                                                                                          <input type="text" name="first_name" value="{{ $user->first_name }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                            <div>
                                                                                                                                                          <label class="block text-gray-700 text-sm font-medium mb-2">Last Name</label>
                                                                                                                                                          <input type="text" name="last_name" value="{{ $user->last_name }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                            <div>
                                                                                                                                                          <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                                                                                                                                                          <input type="email" name="email" value="{{ $user->email }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                            <div>
                                                                                                                                                          <label class="block text-gray-700 text-sm font-medium mb-2">Profile Image URL</label>
                                                                                                                                                          <input type="url" name="profile_image" value="{{ $user->profile_image }}" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                            <div class="col-span-2">
                                                                                                                                                          <label class="block text-gray-700 text-sm font-medium mb-2">Bio</label>
                                                                                                                                                          <textarea name="bio" rows="4" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $user->bio }}</textarea>
                                                                                                                                            </div>
                                                                                                                              </div>
                                                                                                                              
                                                                                                                              <div class="text-right">
                                                                                                                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                                                                                                                                          <i class="fas fa-save mr-2"></i> Update Profile
                                                                                                                                            </button>
                                                                                                                              </div>
                                                                                                                </form>
                                                                                                  </div>
                                                                                    </div>
                                                                      </div>
                                                        @else
                                                                      <div class="text-center py-10">
                                                                                    <i class="fas fa-user-slash text-5xl text-gray-300 mb-3"></i>
                                                                                    <p class="text-gray-500">No user profile found.</p>
                                                                      </div>
                                                        @endif
                                          </div>

                                          <!-- Messages Tab -->
                                          <div x-show="activeTab === 'messages'" class="space-y-8">
                                                        <h2 class="text-2xl font-bold text-gray-800">Messages</h2>
                                                        
                                                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                                                      @forelse($messages as $message)
                                                                                    <div class="border-b border-gray-200 p-6 hover:bg-gray-50">
                                                                                                  <div class="flex justify-between items-start mb-3">
                                                                                                                <div>
                                                                                                                              <h3 class="font-bold text-lg text-gray-800">{{ $message->name }}</h3>
                                                                                                                              <p class="text-blue-600">{{ $message->email }}</p>
                                                                                                                </div>
                                                                                                                <div class="text-gray-500 text-sm">
                                                                                                                              {{ $message->created_at->diffForHumans() }}
                                                                                                                </div>
                                                                                                  </div>
                                                                                                  <p class="text-gray-700">{{ $message->message }}</p>
                                                                                                  <div class="mt-4 text-right">
                                                                                                                <form action="{{ route('messages.destroy', $message->id) }}" method="POST" class="inline">
                                                                                                                              @csrf
                                                                                                                              @method('DELETE')
                                                                                                                              <button type="submit" class="text-red-600 hover:text-red-800">
                                                                                                                                            <i class="fas fa-trash mr-1"></i> Delete
                                                                                                                              </button>
                                                                                                                </form>
                                                                                                  </div>
                                                                                    </div>
                                                                      @empty
                                                                                    <div class="text-center py-10">
                                                                                                  <i class="fas fa-inbox text-5xl text-gray-300 mb-3"></i>
                                                                                                  <p class="text-gray-500">No messages found.</p>
                                                                                    </div>
                                                                      @endforelse
                                                        </div>
                                          </div>
                            </main>

                            <!-- Modal -->
                            <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-transition>
                                          <div class="bg-white rounded-lg shadow-lg max-w-md mx-auto w-full max-h-screen overflow-y-auto p-6">
                                                        <!-- Project Add Modal -->
                                                        <div x-show="modalType === 'project-add'">
                                                                      <div class="flex justify-between items-center mb-4">
                                                                                    <h3 class="text-xl font-bold text-gray-800">Add New Project</h3>
                                                                                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                                                                                                  <i class="fas fa-times"></i>
                                                                                    </button>
                                                                      </div>
                                                                      
                                                                      <form action="{{ route('projects.store') }}" method="POST" class="space-y-4">
                                                                                    @csrf
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                                                                                                  <input type="text" name="title" required class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                                                                                                  <textarea name="description" rows="3" required class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Image URL</label>
                                                                                                  <input type="url" name="image_url" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Project URL</label>
                                                                                                  <input type="url" name="project_url" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Project Type</label>
                                                                                                  <select name="type" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                                                <option value="Web Development">Web Development</option>
                                                                                                                <option value="Mobile App">Mobile App</option>
                                                                                                                <option value="Desktop App">Desktop App</option>
                                                                                                                <option value="UI/UX Design">UI/UX Design</option>
                                                                                                                <option value="Other">Other</option>
                                                                                                  </select>
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Tools</label>
                                                                                                  <div class="grid grid-cols-2 gap-2">
                                                                                                                @foreach($tools as $tool)
                                                                                                                              <div class="flex items-center">
                                                                                                                                            <input type="checkbox" name="tools[]" value="{{ $tool->id }}" id="tool-{{ $tool->id }}" class="mr-2">
                                                                                                                                            <label for="tool-{{ $tool->id }}">{{ $tool->name }}</label>
                                                                                                                              </div>
                                                                                                                @endforeach
                                                                                                  </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="text-right">
                                                                                                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                                                                                                <i class="fas fa-plus mr-2"></i> Add Project
                                                                                                  </button>
                                                                                    </div>
                                                                      </form>
                                                        </div>

                                                        <!-- Project Edit Modal -->
                                                        <div x-show="modalType === 'project-edit'">
                                                                      <div class="flex justify-between items-center mb-4">
                                                                                    <h3 class="text-xl font-bold text-gray-800">Edit Project</h3>
                                                                                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                                                                                                  <i class="fas fa-times"></i>
                                                                                    </button>
                                                                      </div>
                                                                      
                                                                      <form :action="'{{ route('projects.update', '') }}/' + currentItem" method="POST" class="space-y-4">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Title</label>
                                                                                                  <input type="text" name="title" :value="@js($projects).find(p => p.id === currentItem)?.title" required class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                                                                                                  <textarea name="description" rows="3" required class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" x-text="@js($projects).find(p => p.id === currentItem)?.description"></textarea>
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Image URL</label>
                                                                                                  <input type="url" name="image_url" :value="@js($projects).find(p => p.id === currentItem)?.image_url" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Project URL</label>
                                                                                                  <input type="url" name="project_url" :value="@js($projects).find(p => p.id === currentItem)?.project_url" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Project Type</label>
                                                                                                  <select name="type" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" x-model="@js($projects).find(p => p.id === currentItem)?.type">
                                                                                                                <option value="Web Development">Web Development</option>
                                                                                                                <option value="Mobile App">Mobile App</option>
                                                                                                                <option value="Desktop App">Desktop App</option>
                                                                                                                <option value="UI/UX Design">UI/UX Design</option>
                                                                                                                <option value="Other">Other</option>
                                                                                                  </select>
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Tools</label>
                                                                                                  <div class="grid grid-cols-2 gap-2">
                                                                                                                @foreach($tools as $tool)
                                                                                                                              <div class="flex items-center">
                                                                                                                                            <input type="checkbox" name="tools[]" value="{{ $tool->id }}" id="edit-tool-{{ $tool->id }}" class="mr-2" 
                                                                                                                                                          :checked="@js($projects).find(p => p.id === currentItem)?.tools.some(t => t.id === {{ $tool->id }})">
                                                                                                                                            <label for="edit-tool-{{ $tool->id }}">{{ $tool->name }}</label>
                                                                                                                              </div>
                                                                                                                @endforeach
                                                                                                  </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="text-right">
                                                                                                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                                                                                                <i class="fas fa-save mr-2"></i> Update Project
                                                                                                  </button>
                                                                                    </div>
                                                                      </form>
                                                        </div>
                                                        
                                                        <!-- Tool Add Modal -->
                                                        <div x-show="modalType === 'tool-add'">
                                                                      <div class="flex justify-between items-center mb-4">
                                                                                    <h3 class="text-xl font-bold text-gray-800">Add New Tool</h3>
                                                                                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                                                                                                  <i class="fas fa-times"></i>
                                                                                    </button>
                                                                      </div>
                                                                      
                                                                      <form action="{{ route('tools.store') }}" method="POST" class="space-y-4">
                                                                                    @csrf
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Tool Name</label>
                                                                                                  <input type="text" name="name" required class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Image URL</label>
                                                                                                  <input type="url" name="image_url" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div class="text-right">
                                                                                                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                                                                                                <i class="fas fa-plus mr-2"></i> Add Tool
                                                                                                  </button>
                                                                                    </div>
                                                                      </form>
                                                        </div>
                                                        <!-- Tool Edit Modal -->
                                                        <div x-show="modalType === 'tool-edit'">
                                                                      <div class="flex justify-between items-center mb-4">
                                                                                    <h3 class="text-xl font-bold text-gray-800">Edit Tool</h3>
                                                                                    <button @click="showModal = false" class="text-gray-500 hover:text-gray-700">
                                                                                                  <i class="fas fa-times"></i>
                                                                                    </button>
                                                                      </div>
                                                                      
                                                                      <form :action="'{{ route('tools.update', '') }}/' + currentItem" method="POST" class="space-y-4">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Tool Name</label>
                                                                                                  <input type="text" name="name" :value="@js($tools).find(t => t.id === currentItem)?.name" required class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div>
                                                                                                  <label class="block text-gray-700 text-sm font-medium mb-2">Image URL</label>
                                                                                                  <input type="url" name="image_url" :value="@js($tools).find(t => t.id === currentItem)?.image_url" class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                                                    </div>
                                                                                    
                                                                                    <div class="text-right">
                                                                                                  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                                                                                                                <i class="fas fa-save mr-2"></i> Update Tool
                                                                                                  </button>
                                                                                    </div>
                                                                      </form>
                                                        </div>
                                                        <!-- Additional modals for editing would go here -->
                                          </div>
                            </div>

                            <!-- Footer -->
                            <footer class="bg-gray-800 text-white p-6 mt-12">
                                          <div class="container mx-auto text-center">
                                                        <p>© {{ date('Y') }} Portfolio Dashboard. All rights reserved.</p>
                                          </div>
                            </footer>
              </div>
</body>
</html>