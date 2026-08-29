console.log("Custom JS loaded!");

/*
// Handle sidebar toggle using event delegation (more reliable)
document.addEventListener('click', function (e) {
    const toggleButton = e.target.closest('button.sidebar-toggle.primary-toggle');

    if (toggleButton) {
        e.preventDefault();
        e.stopPropagation();

        const sidebar = document.querySelector('.bd-sidebar-primary');
        if (sidebar) {
            sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-visible');
            const isExpanded = sidebar.classList.contains('show');
            toggleButton.setAttribute('aria-expanded', isExpanded);
        }
        return false;
    }

    // Close sidebar when clicking outside
    const sidebar = document.querySelector('.bd-sidebar-primary');
    if (sidebar && document.body.classList.contains('sidebar-visible')) {
        if (!sidebar.contains(e.target) && !e.target.closest('button.sidebar-toggle.primary-toggle')) {
            sidebar.classList.remove('show');
            document.body.classList.remove('sidebar-visible');
        }
    }
}, true);
*/

// ---- SINGLE DOMContentLoaded handler ----
document.addEventListener('DOMContentLoaded', function () {
    console.log("DOM ready!");

    // Convert appendix chapter numbers to letters (A, B, C ...).
    function toAppendixLetter(n) {
        return String.fromCharCode(64 + parseInt(n, 10));
    }

    function convertAppendixNumber(text) {
        return text.replace(/^(\d+)(\.)/, function (_, n, dot) {
            return toAppendixLetter(n) + dot;
        });
    }

    // Sidebar links under the "Appendices" caption render as plain "1. Title".
    document.querySelectorAll('nav.bd-links .caption-text').forEach(function (caption) {
        if (caption.textContent.trim() !== 'Appendices') return;
        var ul = caption.closest('p').nextElementSibling;
        if (!ul) return;
        ul.querySelectorAll('a.reference').forEach(function (a) {
            a.childNodes.forEach(function (node) {
                if (node.nodeType === Node.TEXT_NODE) {
                    node.textContent = convertAppendixNumber(node.textContent);
                }
            });
        });
    });

    var onAppendixPage = false;
    document.querySelectorAll('nav.bd-links .caption-text').forEach(function (caption) {
        if (caption.textContent.trim() !== 'Appendices') return;
        var ul = caption.closest('p').nextElementSibling;
        if (ul && ul.classList.contains('current')) {
            onAppendixPage = true;
        }
    });

    if (onAppendixPage) {
        document.querySelectorAll('.section-number').forEach(function (span) {
            span.textContent = convertAppendixNumber(span.textContent);
        });

        document.querySelectorAll('.left-prev[href], .right-next[href]').forEach(function (a) {
            if (!a.href.includes('/appendices/')) return;
            a.querySelectorAll('.section-number').forEach(function (span) {
                span.textContent = convertAppendixNumber(span.textContent);
            });
        });
    }

    // -----------------------------------------------------------
    // Aftermatter: promote Bibliography and Index sidebar entries
    // from toctree-l1 links to caption-level links (no nesting).
    // Replaces p.caption + ul pair with a single <a> element.
    // -----------------------------------------------------------
    ['Bibliography', 'Index'].forEach(function (name) {
        document.querySelectorAll('nav.bd-links .caption-text').forEach(function (span) {
            if (span.textContent.trim() !== name) return;
            var caption = span.closest('p.caption');
            if (!caption) return;
            var ul = caption.nextElementSibling;
            if (!ul) return;
            var link = ul.querySelector('li > a');
            if (!link) return;

            var a = document.createElement('a');
            a.href = link.href;
            a.textContent = name;
            a.className = 'bd-aftermatter-link';
            if (link.target) a.target = link.target;
            if (link.rel) a.rel = link.rel;

            caption.parentNode.insertBefore(a, caption);
            caption.remove();
            ul.remove();
        });
    });

    // Fix spacing: first aftermatter link gets separation; subsequent ones sit tight
    document.querySelectorAll('a.bd-aftermatter-link').forEach(function (link, i) {
        link.style.marginTop = i === 0 ? '0.5rem' : '0.1rem';
    });

    // -----------------------------------------------------------
    // Lab answer release gate
    //
    // Cells tagged with both hide-input and lab-answer stay hidden
    // until the page declares a release timestamp:
    // <div data-lab-answers-release-at="2026-09-15T23:59:00-05:00"></div>
    // -----------------------------------------------------------
    function getLabAnswersReleaseDate() {
        var releaseNode = document.querySelector('[data-lab-answers-release-at]');
        if (!releaseNode) return null;

        var value = releaseNode.getAttribute('data-lab-answers-release-at');
        if (!value) return null;

        var releaseDate = new Date(value);
        if (Number.isNaN(releaseDate.getTime())) return null;

        return releaseDate;
    }

    var labAnswerCells = Array.from(document.querySelectorAll('.tag_lab-answer'));
    var labAnswersReleaseDate = getLabAnswersReleaseDate();
    var labAnswersReleased = labAnswersReleaseDate !== null && Date.now() >= labAnswersReleaseDate.getTime();

    labAnswerCells.forEach(function (cell) {
        if (labAnswersReleased) {
            cell.classList.add('lab-answer-released');
            return;
        }

        cell.classList.add('lab-answer-locked');
        cell.setAttribute('aria-hidden', 'true');

        if (!cell.previousElementSibling || !cell.previousElementSibling.classList.contains('lab-answer-notice')) {
            var notice = document.createElement('div');
            notice.className = 'lab-answer-notice';
            notice.textContent = labAnswersReleaseDate
                ? 'Answer cell available after the due date.'
                : 'Answer cell available after the due date.';
            cell.parentNode.insertBefore(notice, cell);
        }
    });

    // -----------------------------------------------------------
    // FIX A: tag_hide-input (exercise answer) cells
    //
    // Thebe wraps the entire .thebelab-cell inside <details>, hiding
    // everything. We watch each cell and move the jp-OutputArea wrapper
    // outside <details> the instant Thebe creates it.
    // -----------------------------------------------------------
    // // Thebe activation detection: watch for .thebelab-cell to be created inside <details>, then move output.
    function moveOutputOutsideDetails(cell) {
        var details = cell.querySelector('details');
        if (!details) return;
        var thebelabCell = details.querySelector('.thebelab-cell');
        if (!thebelabCell) return;

        var outputWrapper = null;
        thebelabCell.querySelectorAll(':scope > div').forEach(function (div) {
            if (div.querySelector('.jp-OutputArea')) outputWrapper = div;
        });

        if (outputWrapper && !outputWrapper.dataset.movedOut) {
            outputWrapper.dataset.movedOut = '1';
            details.after(outputWrapper);
            console.log("[fix A] Moved output outside <details> for", cell.id);
        }
    }

    function watchExerciseCell(cell) {
        var details = cell.querySelector('details');
        if (!details) return;

        var observer = new MutationObserver(function () {
            var thebelabCell = details.querySelector('.thebelab-cell');
            if (!thebelabCell) return;

            var outputObserver = new MutationObserver(function () {
                var outputWrapper = null;
                thebelabCell.querySelectorAll(':scope > div').forEach(function (div) {
                    if (div.querySelector('.jp-OutputArea')) outputWrapper = div;
                });
                if (outputWrapper && !outputWrapper.dataset.movedOut) {
                    outputWrapper.dataset.movedOut = '1';
                    details.after(outputWrapper);
                    console.log("[fix A] (delayed) Moved output outside <details> for", cell.id);
                    outputObserver.disconnect();
                }
            });
            outputObserver.observe(thebelabCell, { childList: true, subtree: true });
            moveOutputOutsideDetails(cell);
            observer.disconnect();
        });

        observer.observe(details, { childList: true, subtree: true });
    }

    document.querySelectorAll('.tag_hide-input').forEach(function (cell) {
        if (cell.classList.contains('tag_lab-answer') && !cell.classList.contains('lab-answer-released')) return;
        watchExerciseCell(cell);
    });

    // -----------------------------------------------------------
    // FIX B: Demo cells — hide jp-OutputArea when Thebe activates.
    //
    // Since body.thebelab-active is never set by Thebe 0.8.2,
    // we detect activation by watching for the first
    // .thebelab-run-button to appear in the DOM, then add our own
    // class 'thebe-is-active' to body so CSS can target it.
    //
    // NOTE: thinkpy uses predefinedOutput: true (default), so
    // static outputs are visible. No Fix A needed — exercise cell
    // outputs are not hidden by Thebe in this config.
    // -----------------------------------------------------------

    var thebeActivated = false;

    var activationObserver = new MutationObserver(function () {
        if (thebeActivated) return;
        if (document.querySelector('.thebelab-run-button')) {
            thebeActivated = true;
            activationObserver.disconnect();
            document.body.classList.add('thebe-is-active');
            console.log("[fix B] Thebe detected — added thebe-is-active to body");

            // Bind directly to every run button now that they exist
            document.querySelectorAll('.thebelab-run-button').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var cell = btn.closest('.cell');
                    if (cell && !cell.classList.contains('tag_hide-input')) {
                        cell.classList.add('cell-has-run');
                        console.log("[fix B] Marked cell-has-run for", cell.id);
                    }
                });
            });
        }
    });
    activationObserver.observe(document.body, { childList: true, subtree: true });

    // Exercise counter labels
    const exercises = document.querySelectorAll('div.cell.tag_thebe-interactive');
    const total = exercises.length;

    exercises.forEach((exercise, index) => {
        // Skip if label already exists
        if (exercise.querySelector('.exercise-label')) return;

        const counter = index + 1;
        const label = document.createElement('div');
        label.className = 'exercise-label';
        label.innerHTML = `✏️ Interactive Exercise ${counter}/${total}`;
        label.style.cssText = `
            display: block;
            font-size: 0.85em;
            color: #771212;
            font-weight: bold;
            margin-bottom: 8px;
        `;
        exercise.insertBefore(label, exercise.firstChild);
    });
});

// Add student account panel at the bottom of the left sidebar.
function getAccountInitials(identity) {
    var value = '';
    if (identity) {
        value = identity.display_name || identity.email || identity.student_identifier || '';
    }
    value = String(value).trim();
    if (!value) return '';

    if (value.indexOf('@') !== -1) {
        value = value.split('@')[0];
    }

    var parts = value
        .replace(/[^a-zA-Z0-9\s._-]/g, ' ')
        .split(/[\s._-]+/)
        .filter(Boolean);

    if (parts.length >= 2) {
        return (parts[0][0] + parts[1][0]).toUpperCase();
    }
    return value.slice(0, 2).toUpperCase();
}

function addStudentAccountPanel() {
    var nav = document.querySelector('nav.bd-links');
    if (!nav) return;
    if (nav.querySelector('.bd-student-links')) return;

    var currentPath = window.location.pathname + window.location.search + window.location.hash;
    var wrapper = document.createElement('div');
    wrapper.className = 'bd-student-links';

    var header = document.createElement('button');
    header.type = 'button';
    header.className = 'bd-student-header';
    header.setAttribute('aria-expanded', 'false');
    header.setAttribute('aria-label', 'Student account menu');

    var avatar = document.createElement('div');
    avatar.className = 'bd-student-avatar';

    header.appendChild(avatar);
    wrapper.appendChild(header);

    var actions = document.createElement('div');
    actions.className = 'bd-student-actions';

    var login = document.createElement('a');
    login.className = 'bd-student-button';
    login.href = '/api/student/login.php?next=' + encodeURIComponent(currentPath);
    login.textContent = 'Login';

    var signup = document.createElement('a');
    signup.className = 'bd-student-button';
    signup.href = '/api/student/login.php?next=' + encodeURIComponent(currentPath) + '&tab=signup';
    signup.textContent = 'Sign Up';

    actions.appendChild(login);
    actions.appendChild(signup);
    wrapper.appendChild(actions);

    header.addEventListener('click', function () {
        var isOpen = wrapper.classList.toggle('is-open');
        header.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
    nav.appendChild(wrapper);

    fetch('/api/v1/session.php', { credentials: 'same-origin' })
        .then(function (response) { return response.ok ? response.json() : null; })
        .then(function (payload) {
            if (!payload || !payload.authenticated || !payload.identity) return;

            var initials = getAccountInitials(payload.identity);
            if (initials) {
                avatar.textContent = initials;
                avatar.classList.add('has-initials');
            }

            if (payload.role === 'admin') {
                var adminLogoutPath = '/api/admin/logout.php?next=' + encodeURIComponent(currentPath);
                var adminLinks = [
                    ['Attempts', '/api/admin/'],
                    ['Score Report', '/api/admin/report.php'],
                    ['Users', '/api/admin/users.php'],
                    ['Assignments', '/api/admin/assignments.php'],
                    ['Log Out', adminLogoutPath, false],
                ].map(function (item) {
                    var link = document.createElement('a');
                    link.className = 'bd-student-button';
                    link.href = item[1];
                    link.textContent = item[0];
                    if (item[2] !== false) {
                        link.target = '_blank';
                        link.rel = 'noopener';
                    }
                    return link;
                });
                actions.replaceChildren.apply(actions, adminLinks);
                return;
            }

            var account = document.createElement('a');
            account.className = 'bd-student-button';
            account.href = '/api/student/account.php';
            account.target = '_blank';
            account.rel = 'noopener';
            account.textContent = 'Account';

            var scores = document.createElement('a');
            scores.className = 'bd-student-button';
            scores.href = '/api/student/scores.php';
            scores.target = '_blank';
            scores.rel = 'noopener';
            scores.textContent = 'My Scores';

            var logout = document.createElement('a');
            logout.className = 'bd-student-button';
            logout.href = '/api/student/logout.php?next=' + encodeURIComponent(currentPath);
            logout.textContent = 'Log Out';

            actions.replaceChildren(account, scores, logout);
        })
        .catch(function () {});
}

document.addEventListener('DOMContentLoaded', function () {
    addStudentAccountPanel();

    var sidebar = document.querySelector('.bd-sidebar-primary');
    if (!sidebar || sidebar.querySelector('.bd-student-links')) return;

    var accountObserver = new MutationObserver(function () {
        addStudentAccountPanel();
        if (sidebar.querySelector('.bd-student-links')) {
            accountObserver.disconnect();
        }
    });
    accountObserver.observe(sidebar, { childList: true, subtree: true });
});
