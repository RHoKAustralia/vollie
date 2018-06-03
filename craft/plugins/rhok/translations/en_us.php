<?php

$statusUpdateEmailBody = <<<EOF
Hi {{user.firstName}},

This is a quick email to check-in and see how your project {{ project.title }} is tracking? Please click one of the below links so we know where you’re at. This way we can provide you the best possible service - we’re always here to help! 👩‍💻👨‍💻

a. Work-in-progress ({{activeLink}})

b. Complete ({{completedLink}})

c. Re-list – Volunteers selected and subsequently not suitable/un-engaged
{{relistLink}}

If you need help (including if you need re-list), you can do so by replying to this email and we’ll be in touch ASAP.

Regards,

Team Vollie

EOF;

return [
    'rhok_statusUpdate_heading' => 'How’s your project tracking?',
    'rhok_statusUpdate_subject' => 'How’s your project tracking?',
    'rhok_statusUpdate_body' => $statusUpdateEmailBody
];