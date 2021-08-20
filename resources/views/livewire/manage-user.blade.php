    <div class="row">
        <div class="col-md-12" style="padding-bottom: 2.5%;">
              <button type="button" class="btn btn-secondary" wire:click="showAdmins" style="padding: 2%;">Admins</button>
              <button type="button" class="btn btn-secondary" wire:click="showWriters" style="padding: 2%;">Writers</button>
              <button type="button" class="btn btn-secondary" wire:click="showTeachers" style="padding: 2%;">Teachers</button>
              <button type="button" class="btn btn-secondary" wire:click="showStudents" style="padding: 2%;">students</button>
              <button type="button" class="btn btn-secondary" wire:click="showAll" style="padding: 2%;float: right;">All users</button>
        </div>
        <div class="col-md-12">
            @if($messageForm == false)
                <button type="button" class="btn btn-warning" wire:click="openMessageForm" style="float: right;">Open message form</button>
            @elseif($messageForm == true)
                <button type="button" class="btn btn-warning" wire:click="closeMessageForm" style="float: right;">Close message form</button><br><br>
                <div class="card card-primary" style="padding: 0%;margin: 0%;">
                  <div class="card-header">
                    <h3 class="card-title">Send message from admin to users</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="POST" action="{{ route('message.store') }}">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Message content</label>
                        <textarea class="form-control" name="message" rows="3" placeholder="Enter about padcast ..."></textarea>
                      </div>
                      <div class="form-group">
                        <label>Select Audiences</label>
                        <select class="form-control" name="audiences">
                          <option value="all" selected>All users</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Send</button>
                    </div>
                  </form>
                </div>
            @endif
            
        </div>
        <div class="col-md-12" style="padding-top: 2.5%;">
            <div class="card" style="padding-left: 0;margin-left: 0;min-width: 360px;">  
              <div class="card-header">
                <h3 class="card-title">{{ strtoupper($showtype) }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th >Email</th>
                      <th >Role</th>
                      <th >Action</th>
                      <th>Manage Role</th>
                    </tr>
                  </thead>
                  @if($showtype == 'all')
                    @foreach($users as $user)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">
                                {{ $user->email }}
                                <br>
                                <i class="far fa-comments" 
                                    @if($userMessageForm != $user->id)
                                        wire:click="showMessageUserFrom({{ $user->id }})"
                                    @elseif($userMessageForm == $user->id)
                                        wire:click="hiddenMessageUserFrom({{ $user->id }})"
                                    @endif
                                ></i>
                              </td>
                              <td >
                                @foreach($user->roles as $role)
                                    {{ $role->name . ' '}}
                                @endforeach
                              </td>
                              <td>
                                 <p><button class="nav-link" wire:click="removeUser({{ $user->id }})">Remove</button></p>  
                              </td>
                              <td>
                                  <div class="btn-group">
                                      <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu">
                                        @foreach($roles as $role)
                                            <button class="nav-link" wire:click="userSyncRole({{ $user->id }}, {{ $role->id }})">
                                                {{ $role->name }}
                                            </button>
                                        @endforeach
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($userMessageForm == $user->id)
                                <tr>
                                    <td>
                                        <div class="card card-primary" style="padding: 0%;margin: 0%;">
                                          <div class="card-header">
                                            <h3 class="card-title">Send message from admin to {{ $user->name }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form method="POST" action="{{ route('usermessage.store', $user) }}">
                                            @csrf
                                            <div class="card-body">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Message content</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Enter about padcast ..."></textarea>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                              <button type="submit" name="submit" class="btn btn-primary">Send</button>
                                            </div>
                                          </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'admin')
                    @foreach($admins as $user)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">
                                {{ $user->email }}
                                <br>
                                <i class="far fa-comments" 
                                    @if($userMessageForm != $user->id)
                                        wire:click="showMessageUserFrom({{ $user->id }})"
                                    @elseif($userMessageForm == $user->id)
                                        wire:click="hiddenMessageUserFrom({{ $user->id }})"
                                    @endif
                                ></i>
                              </td>
                              <td >
                                @foreach($user->roles as $role)
                                    {{ $role->name . ' '}}
                                @endforeach
                              </td>
                              <td>
                                 <p><button class="nav-link" wire:click="removeUser({{ $user->id }})">Remove</button></p>  
                              </td>
                              <td>
                                  <div class="btn-group">
                                      <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu">
                                        @foreach($roles as $role)
                                            <button class="nav-link" wire:click="userSyncRole({{ $user->id }}, {{ $role->id }})">
                                                {{ $role->name }}
                                            </button>
                                        @endforeach
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($userMessageForm == $user->id)
                                <tr>
                                    <td>
                                        <div class="card card-primary" style="padding: 0%;margin: 0%;">
                                          <div class="card-header">
                                            <h3 class="card-title">Send message from admin to {{ $user->name }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form method="POST" action="{{ route('usermessage.store', $user) }}">
                                            @csrf
                                            <div class="card-body">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Message content</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Enter about padcast ..."></textarea>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                              <button type="submit" name="submit" class="btn btn-primary">Send</button>
                                            </div>
                                          </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'writer')
                    @foreach($writers as $user)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">
                                {{ $user->email }}
                                <br>
                                <i class="far fa-comments" 
                                    @if($userMessageForm != $user->id)
                                        wire:click="showMessageUserFrom({{ $user->id }})"
                                    @elseif($userMessageForm == $user->id)
                                        wire:click="hiddenMessageUserFrom({{ $user->id }})"
                                    @endif
                                ></i>
                              </td>
                              <td >
                                @foreach($user->roles as $role)
                                    {{ $role->name . ' '}}
                                @endforeach
                              </td>
                              <td>
                                 <p><button class="nav-link" wire:click="removeUser({{ $user->id }})">Remove</button></p>  
                              </td>
                              <td>
                                  <div class="btn-group">
                                      <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu">
                                        @foreach($roles as $role)
                                            <button class="nav-link" wire:click="userSyncRole({{ $user->id }}, {{ $role->id }})">
                                                {{ $role->name }}
                                            </button>
                                        @endforeach
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($userMessageForm == $user->id)
                                <tr>
                                    <td>
                                        <div class="card card-primary" style="padding: 0%;margin: 0%;">
                                          <div class="card-header">
                                            <h3 class="card-title">Send message from admin to {{ $user->name }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form method="POST" action="{{ route('usermessage.store', $user) }}">
                                            @csrf
                                            <div class="card-body">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Message content</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Enter about padcast ..."></textarea>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                              <button type="submit" name="submit" class="btn btn-primary">Send</button>
                                            </div>
                                          </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'teacher')
                    @foreach($teachers as $user)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">
                                {{ $user->email }}
                                <br>
                                <i class="far fa-comments" 
                                    @if($userMessageForm != $user->id)
                                        wire:click="showMessageUserFrom({{ $user->id }})"
                                    @elseif($userMessageForm == $user->id)
                                        wire:click="hiddenMessageUserFrom({{ $user->id }})"
                                    @endif
                                ></i>
                              </td>
                              <td >
                                @foreach($user->roles as $role)
                                    {{ $role->name . ' '}}
                                @endforeach
                              </td>
                              <td>
                                 <p><button class="nav-link" wire:click="removeUser({{ $user->id }})">Remove</button></p>  
                              </td>
                              <td>
                                  <div class="btn-group">
                                      <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu">
                                        @foreach($roles as $role)
                                            <button class="nav-link" wire:click="userSyncRole({{ $user->id }}, {{ $role->id }})">
                                                {{ $role->name }}
                                            </button>
                                        @endforeach
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($userMessageForm == $user->id)
                                <tr>
                                    <td>
                                        <div class="card card-primary" style="padding: 0%;margin: 0%;">
                                          <div class="card-header">
                                            <h3 class="card-title">Send message from admin to {{ $user->name }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form method="POST" action="{{ route('usermessage.store', $user) }}">
                                            @csrf
                                            <div class="card-body">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Message content</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Enter about padcast ..."></textarea>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                              <button type="submit" name="submit" class="btn btn-primary">Send</button>
                                            </div>
                                          </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                  @if($showtype == 'student')
                    @foreach($students as $user)
                        <tbody>
                            <tr>
                              <td style="font-size: 80%;">
                                {{ $user->email }}
                                <br>
                                <i class="far fa-comments" 
                                    @if($userMessageForm != $user->id)
                                        wire:click="showMessageUserFrom({{ $user->id }})"
                                    @elseif($userMessageForm == $user->id)
                                        wire:click="hiddenMessageUserFrom({{ $user->id }})"
                                    @endif
                                ></i>
                              </td>
                              <td >
                                @foreach($user->roles as $role)
                                    {{ $role->name . ' '}}
                                @endforeach
                              </td>
                              <td>
                                 <p><button class="nav-link" wire:click="removeUser({{ $user->id }})">Remove</button></p>  
                              </td>
                              <td>
                                  <div class="btn-group">
                                      <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                      </button>
                                      <div class="dropdown-menu">
                                        @foreach($roles as $role)
                                            <button class="nav-link" wire:click="userSyncRole({{ $user->id }}, {{ $role->id }})">
                                                {{ $role->name }}
                                            </button>
                                        @endforeach
                                      </div>
                                    </div>
                              </td>
                            </tr>
                            @if($userMessageForm == $user->id)
                                <tr>
                                    <td>
                                        <div class="card card-primary" style="padding: 0%;margin: 0%;">
                                          <div class="card-header">
                                            <h3 class="card-title">Send message from admin to {{ $user->name }}</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <!-- form start -->
                                          <form method="POST" action="{{ route('usermessage.store', $user) }}">
                                            @csrf
                                            <div class="card-body">
                                              <div class="form-group">
                                                <label for="exampleInputEmail1">Message content</label>
                                                <textarea class="form-control" name="message" rows="3" placeholder="Enter about padcast ..."></textarea>
                                              </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                              <button type="submit" name="submit" class="btn btn-primary">Send</button>
                                            </div>
                                          </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    @endforeach
                  @endif
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

