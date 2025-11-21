<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Job Postings</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
          "Helvetica Neue", Arial, sans-serif;
        background-color: #ffe1e1;
        padding: 20px;
        line-height: 1.6;
      }

      .email-wrapper {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      }

      .header-section {
        background-color: #ffffff;
        padding: 30px 40px 20px;
        text-align: center;
        border-bottom: 1px solid #e5e5e5;
      }

      .header-title {
        font-size: 22px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
      }

      .header-subtitle {
        font-size: 14px;
        color: #666666;
      }

      .hero-banner {
        background: linear-gradient(135deg, #1e3a8a 0%, #7c2d12 100%);
        padding: 60px 40px;
        text-align: center;
      }

      .hero-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        background-color: rgba(255, 255, 255, 0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: rotate(-5deg);
      }

      .hero-icon-inner {
        width: 100px;
        height: 100px;
        background-color: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #1e3a8a;
        font-weight: 700;
      }

      .info-section {
        padding: 30px 40px;
        text-align: center;
        background-color: #ffffff;
      }

      .info-text {
        font-size: 15px;
        color: #333333;
        line-height: 1.6;
        margin-bottom: 20px;
      }

      .cta-button {
        display: inline-block;
        background-color: #BDAFFAFF;
        border: 2px solid #522DD7FF;
        color: white;
        padding: 12px 30px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 14px;
        transition: background-color 0.3s ease;
      }

      .cta-button:hover {
        background-color: #C7BAF7FF;
      }

      .jobs-container {
        padding: 20px 40px;
      }

      .job-card {
        background-color: #ffffff;
        border: 1px solid #e5e5e5;
        margin-bottom: 20px;
        border-radius: 4px;
        overflow: hidden;
      }

      .job-header {
        background-color: #7f1d1d;
        padding: 20px;
        border-bottom: 1px solid #e5e5e5;
      }

      .company-row {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
      }

      .company-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 14px;
        flex-shrink: 0;
      }

      .company-icon-letter {
        color: #ffffff;
        font-size: 22px;
        font-weight: 700;
      }

      .company-name {
        font-size: 16px;
        font-weight: 700;
        color: #fffdfd;
      }

      .job-title {
        font-size: 20px;
        font-weight: 700;
        color: #f8f3f3;
      }

      .job-body {
        padding: 20px;
      }

      .job-description {
        font-size: 14px;
        color: #1b1b1b;
        line-height: 1.6;
        margin-bottom: 18px;
      }

      .job-detail-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px;
        font-size: 14px;
      }

      .detail-label {
        font-weight: 600;
        color: #222121;
        min-width: 90px;
      }

      .detail-value {
        color: #202020;
      }

      .salary-box {
        background-color: #059669;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 4px;
        display: inline-block;
        font-weight: 700;
        font-size: 14px;
        margin-top: 4px;
      }

      .tags-section {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e5e5e5;
      }

      .tag {
        display: inline-block;
        background-color: #e8f0fe;
        color: #1e40af;
        padding: 5px 12px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 600;
        margin-right: 6px;
        margin-bottom: 6px;
      }

      .features-section {
        padding: 30px 40px;
        background-color: #fafafa;
      }

      .feature-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 24px;
      }

      .feature-icon-box {
        width: 50px;
        height: 50px;
        background-color: #1e3a8a;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        flex-shrink: 0;
      }

      .feature-icon {
        color: #ffffff;
        font-size: 24px;
        font-weight: 700;
      }

      .feature-content {
        flex: 1;
      }

      .feature-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 6px;
      }

      .feature-description {
        font-size: 14px;
        color: #222222;
        line-height: 1.5;
      }

      .footer-section {
        padding: 30px 40px;
        text-align: center;
        background-color: #ffffff;
        border-top: 1px solid #e5e5e5;
      }

      .footer-question {
        font-size: 14px;
        color: #242323;
        margin-bottom: 8px;
      }

      .footer-link {
        color: #1e3a8a;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
      }

      .footer-link:hover {
        text-decoration: underline;
      }

      @media only screen and (max-width: 600px) {
        body {
          padding: 10px;
        }

        .header-section,
        .hero-banner,
        .info-section,
        .jobs-container,
        .features-section,
        .footer-section {
          padding-left: 20px;
          padding-right: 20px;
        }

        .job-header,
        .job-body {
          padding: 15px;
        }

        .feature-item {
          flex-direction: column;
        }

        .feature-icon-box {
          margin-bottom: 12px;
        }
      }
    </style>
  </head>
  <body>
    <div class="email-wrapper">
      <!-- Header -->
      <div class="header-section">
        <div class="header-title">New Job Opportunities Available</div>
        <div class="header-subtitle">Discover your next career move</div>
      </div>

      <!-- Hero Banner -->
      <img
        style="width: 100%"
        src="https://img.freepik.com/premium-photo/we-are-hiring-design-with-magnifying-glass-yellow-background-minimal-we-are-hiring_1088296-213.jpg"
      />

      <!-- Info Section -->
      <div class="info-section">
        <p class="info-text">
          <strong>Hello {{ $user->first_name }} {{ $user->last_name }},</strong
          ><br />
          We've curated {{ count($careers) }} exciting job {{ count($careers) ==
          1 ? 'opportunity' : 'opportunities' }} that match your profile. These
          positions are from top companies looking for talented professionals
          like you.
        </p>
        <a href="#" class="cta-button">View All Opportunities</a>
      </div>

      <!-- Jobs Container -->
      <div class="jobs-container">
        @foreach($careers as $career)
        <div class="job-card">
          <div class="job-header">
            <div class="company-row">
              <!-- <div class="company-icon-box">
                <img
                  style="width: 100%; height: 100%"
                  src="https://img.freepik.com/premium-photo/we-are-hiring-design-with-magnifying-glass-yellow-background-minimal-we-are-hiring_1088296-213.jpg"
                />
              </div> -->
              <div class="company-name">{{ $career->company->name }}</div>
            </div>
            <div class="job-title">{{ $career->title }}</div>
          </div>

          <div class="job-body">
            <div class="job-description">{{ $career->description }}</div>

            <div class="job-detail-item">
              <span class="detail-label">Location:</span>
              <span class="detail-value">{{ $career->location }}</span>
            </div>

            <div class="job-detail-item">
              <span class="detail-label">Role Type:</span>
              <span class="detail-value">{{ $career->role_type }}</span>
            </div>

            @if($career->min_salary && $career->max_salary)
            <div class="job-detail-item">
              <span class="detail-label">Salary:</span>
              <div>
                <span class="salary-box">
                  ${{ number_format($career->min_salary) }} - ${{
                  number_format($career->max_salary) }}
                </span>
              </div>
            </div>
            @endif @if($career->tags && count($career->tags) > 0)
            <div class="tags-section">
              @foreach($career->tags as $tag)
              <span class="tag">{{ $tag }}</span>
              @endforeach
            </div>
            @endif
          </div>
        </div>
        @endforeach
      </div>

      <!-- Footer -->
      <div class="footer-section">
        <div class="footer-question">Have a question?</div>
        <a href="mailto:support@jobportal.com" class="footer-link"
          >support@jobportal.com</a
        >

        <p style="margin-top: 20px; font-size: 14px; color: #666666">
          Best regards,<br />
          <strong>The Job Portal Team</strong>
        </p>
      </div>
    </div>
  </body>
</html>
