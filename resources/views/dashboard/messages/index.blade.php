@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- Page Header --}}
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            {{ __('messages.messages_title') }}
                        </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ __('messages.messages_title') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- Messages Table --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table comman-shadow">
                    <div class="card-body">

                        <div class="page-header d-flex justify-content-between align-items-center mb-3">
                            <div class="page-title">
                                <h4>
                                    {{ __('messages.contact_inquiries') }}
                                    @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                                    @if($unread > 0)
                                    <span class="badge bg-danger ms-2">{{ $unread }} new</span>
                                    @endif
                                </h4>
                            </div>
                        </div>

                        <div class="table-responsive">
                            {{--
                                NOTE: 'datatable' class removed intentionally.
                                script.js auto-inits any .datatable table without language config.
                                We init this table manually below with the correct locale strings.
                            --}}
                            <table id="messagesTable"
                                   class="table border-0 star-student table-hover table-center mb-0 table-striped">
                                <thead class="student-thread">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('messages.field_name') }}</th>
                                        <th>{{ __('messages.field_phone') }}</th>
                                        <th>{{ __('messages.field_email') }}</th>
                                        <th>{{ __('messages.field_subject') }}</th>
                                        <th>{{ __('messages.field_message') }}</th>
                                        <th>{{ __('messages.msg_col_date') }}</th>
                                        <th class="text-end">{{ __('messages.msg_col_action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($messages as $msg)
                                    <tr class="{{ $msg->is_read ? '' : 'table-warning fw-semibold' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $msg->name }}</td>
                                        <td>
                                            @if($msg->phone)
                                                <a href="tel:{{ $msg->phone }}">{{ $msg->phone }}</a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($msg->email)
                                                <a href="mailto:{{ $msg->email }}">{{ $msg->email }}</a>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $msg->subject }}</td>
                                        <td>
                                            <span title="{{ $msg->message }}">
                                                {{ Str::limit($msg->message, 60) }}
                                            </span>
                                        </td>
                                        <td>{{ $msg->created_at->format('d M Y, H:i') }}</td>
                                        <td class="text-end">
                                            <form action="{{ route('messages/delete') }}" method="POST"
                                                  onsubmit="return confirm('{{ __('messages.msg_delete_confirm') }}')">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $msg->id }}">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                    {{ __('messages.btn_delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-5">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            {{ __('messages.no_messages') }}
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {
    // Locale-aware DataTable initialisation for the Messages inbox.
    // All UI strings are rendered server-side by Laravel's __() helper
    // so they switch automatically with the active locale.
    $('#messagesTable').DataTable({
        order: [[6, 'desc']], // sort by Date descending by default
        columnDefs: [
            { orderable: false, targets: [7] } // Action column not sortable
        ],
        language: {
            search:           "{{ __('messages.dt_search') }}",
            lengthMenu:       "{{ __('messages.dt_show') }} _MENU_ {{ __('messages.dt_entries') }}",
            zeroRecords:      "{{ __('messages.dt_empty') }}",
            emptyTable:       "{{ __('messages.dt_zero') }}",
            info:             "{{ __('messages.dt_showing') }} _START_ {{ __('messages.dt_to') }} _END_ {{ __('messages.dt_of') }} _TOTAL_ {{ __('messages.dt_results') }}",
            infoEmpty:        "{{ __('messages.dt_showing') }} 0 {{ __('messages.dt_to') }} 0 {{ __('messages.dt_of') }} 0 {{ __('messages.dt_results') }}",
            infoFiltered:     "({{ __('messages.dt_filtered') }} _MAX_ {{ __('messages.dt_total') }})",
            paginate: {
                first:    "{{ __('messages.dt_first') }}",
                last:     "{{ __('messages.dt_last') }}",
                next:     "{{ __('messages.dt_next') }}",
                previous: "{{ __('messages.dt_previous') }}"
            }
        }
    });
});
</script>
@endsection
