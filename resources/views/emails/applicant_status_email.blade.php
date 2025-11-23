<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Application Status Update</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
          "Helvetica Neue", Arial, sans-serif;
        background-color: #f5f5f5;
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
        background-color: {{ $status === 'approved' ? '#10b981' : '#ef4444' }};
        padding: 30px 40px;
        text-align: center;
        color: white;
      }

      .header-title {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
      }

      .header-subtitle {
        font-size: 16px;
        opacity: 0.9;
      }

      .content-section {
        padding: 40px;
      }

      .greeting {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #1a1a1a;
      }

      .status-message {
        background-color: {{ $status === 'approved' ? '#ecfdf5' : '#fef2f2' }};
        border: 1px solid {{ $status === 'approved' ? '#10b981' : '#ef4444' }};
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
      }

      .status-title {
        font-size: 20px;
        font-weight: 700;
        color: {{ $status === 'approved' ? '#047857' : '#dc2626' }};
        margin-bottom: 10px;
      }

      .message-content {
        font-size: 16px;
        color: #374151;
        line-height: 1.6;
      }

      .message-content h1, .message-content h2, .message-content h3 {
        margin-top: 20px;
        margin-bottom: 10px;
        color: #1a1a1a;
      }

      .message-content p {
        margin-bottom: 10px;
      }

      .message-content ul, .message-content ol {
        margin-left: 20px;
        margin-bottom: 10px;
      }

      .message-content code {
        background-color: #f3f4f6;
        padding: 2px 4px;
        border-radius: 4px;
        font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
      }

      .footer-section {
        padding: 30px 40px;
        text-align: center;
        background-color: #f9fafb;
        border-top: 1px solid #e5e5e5;
      }

      .footer-text {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 10px;
      }

      .footer-link {
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
      }

      .footer-link:hover {
        text-decoration: underline;
      }

      @media only screen and (max-width: 600px) {
        body {
          padding: 10px;
        }

        .header-section,
        .content-section,
        .footer-section {
          padding-left: 20px;
          padding-right: 20px;
        }
      }
    </style>
  </head>
  <body>
    <div class="email-wrapper">
      <!-- Header -->
      <div class="header-section">
        <div class="header-title">
          Application {{ ucfirst($status) }}
        </div>
        <div class="header-subtitle">
          {{ $applicant->career->title }} at {{ $applicant->company->name }}
        </div>
      </div>

      <!-- Content -->
      <div class="content-section">
        <div class="greeting">
          Dear {{ $applicant->user->first_name }} {{ $applicant->user->last_name }},
        </div>

        <div class="status-message">
          <div class="status-title">
            Your application has been {{ $status }}!
          </div>
          <div class="message-content">
            {!! Str::markdown($message) !!}
          </div>
        </div>

        <p style="font-size: 16px; color: #374151;">
          Thank you for your interest in {{ $applicant->company->name }}.
        </p>
      </div>

      <!-- Footer -->
      <div class="footer-section">
        <div class="footer-text">
          If you have any questions, please contact us at
          <a href="mailto:support@jobportal.com" class="footer-link">support@jobportal.com</a>
        </div>

        <p style="margin-top: 20px; font-size: 14px; color: #6b7280">
          Best regards,<br />
          <strong>The Job Portal Team</strong>
        </p>
      </div>
    </div>
  </body>
</html>