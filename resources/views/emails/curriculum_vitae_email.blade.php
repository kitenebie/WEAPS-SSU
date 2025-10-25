<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    <h2>Email Content</h2>
    <div>{!! $content !!}</div>

    <h2>Applicant Details</h2>
    <p><strong>Name:</strong> {{ $cv->first_name }} {{ $cv->last_name }}</p>
    <p><strong>Email:</strong> {{ $cv->email }}</p>
    <p><strong>Phone:</strong> {{ $cv->phone }}</p>
    <p><strong>Address:</strong> {{ $cv->address }}</p>
    <p><strong>Job Title:</strong> {{ $cv->job_title }}</p>
    <p><strong>Summary:</strong> {{ $cv->summary }}</p>
    <p><strong>Years of Experience:</strong> {{ $cv->years_of_experience }}</p>

    @if($cv->work_experience)
    <h3>Work Experience</h3>
    <ul>
        @foreach($cv->work_experience as $work)
        <li>{{ $work['jobPosition'] }} at {{ $work['company_name'] }} ({{ $work['start_date'] }} - {{ $work['end_date'] }})</li>
        @endforeach
    </ul>
    @endif

    @if($cv->education)
    <h3>Education</h3>
    <ul>
        @foreach($cv->education as $edu)
        <li>{{ $edu['degree'] }} from {{ $edu['school_name'] }} ({{ $edu['year_graduated'] }})</li>
        @endforeach
    </ul>
    @endif

    @if($cv->skills)
    <h3>Skills</h3>
    <ul>
        @foreach($cv->skills as $skill)
        <li>{{ $skill['name'] }} ({{ $skill['level'] }})</li>
        @endforeach
    </ul>
    @endif
</body>
</html>