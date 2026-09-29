{{-- Shared directory card for doctors and nurses --}}
@props(['person', 'type' => 'doctor'])

<article class="card person-card hover-lift"
         data-filter-item
         data-search="{{ $person['name'] }} {{ $person['title'] }} {{ $person['department'] }} {{ $person['rank'] }}"
         data-group="{{ $person['department'] }}"
         data-status="{{ $person['status'] }}">

    <div class="person-head">
        <x-avatar :name="$person['name']" :size="64" />
        <div>
            <h3>{{ $person['name'] }}</h3>
            <div class="spec">{{ $person['title'] }}</div>
            <x-badge :status="$person['status']" style="margin-top:6px" />
        </div>
    </div>

    <div class="person-facts">
        <div class="fact"><small>Department</small><strong>{{ $person['department'] }}</strong></div>
        <div class="fact"><small>{{ $type === 'doctor' ? 'Rank' : 'Role' }}</small><strong>{{ $person['rank'] }}</strong></div>
        <div class="fact"><small>Experience</small><strong>{{ $person['experience'] }} yrs</strong></div>
        <div class="fact"><small>{{ $type === 'doctor' ? 'Schedule' : 'Shift' }}</small><strong>{{ $person['schedule'] }}</strong></div>
    </div>

    <div class="person-line"><i class="fa-solid fa-award"></i> {{ $person['credentials'] }}</div>
    <div class="person-line"><i class="fa-solid fa-hospital"></i> {{ $person['hospital'] }}</div>

    <div class="person-actions">
        <button type="button" class="btn btn-outline btn-sm" onclick="openModal('modal-{{ $type }}-{{ $person['id'] }}')">
            <i class="fa-regular fa-id-badge"></i> {{ $type === 'doctor' ? 'View Profile' : 'Details' }}
        </button>
        @if ($type === 'doctor')
            <button type="button" class="btn btn-primary btn-sm" onclick="openModal('modal-{{ $type }}-{{ $person['id'] }}')">
                <i class="fa-regular fa-calendar-check"></i> Appointment
            </button>
        @endif
    </div>
</article>

{{-- Profile modal --}}
<div class="modal" id="modal-{{ $type }}-{{ $person['id'] }}" onclick="if(event.target===this)closeModal(this.id)">
    <div class="modal-box">
        <button class="icon-btn modal-close" type="button" onclick="closeModal('modal-{{ $type }}-{{ $person['id'] }}')" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>

        <div class="person-head">
            <x-avatar :name="$person['name']" :size="72" />
            <div>
                <h3>{{ $person['name'] }}</h3>
                <div class="spec">{{ $person['title'] }} · {{ $person['department'] }}</div>
                <x-badge :status="$person['status']" style="margin-top:6px" />
            </div>
        </div>

        <p style="color:var(--ink-2);font-size:14px">{{ $person['bio'] }}</p>

        <h4>Credentials</h4>
        <div class="tag-list">
            @foreach (explode(',', $person['credentials']) as $cred)
                <span class="tag">{{ trim($cred) }}</span>
            @endforeach
        </div>

        <h4>{{ $type === 'doctor' ? 'Clinic Schedule' : 'Assigned Shift' }}</h4>
        <div class="person-line"><i class="fa-regular fa-clock"></i> {{ $person['schedule'] }} · {{ $person['hospital'] }}</div>
        <div class="person-line" style="margin-top:6px"><i class="fa-solid fa-phone"></i> Local {{ $person['local'] }}</div>

        @if ($type === 'doctor')
            <div class="person-actions" style="margin-top:22px">
                <a href="tel:+63282821111" class="btn btn-outline"><i class="fa-solid fa-phone"></i> Call clinic</a>
                <a href="{{ route('register') }}" class="btn btn-primary"><i class="fa-regular fa-calendar-check"></i> Book appointment</a>
            </div>
        @endif
    </div>
</div>
