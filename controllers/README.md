# Directory /controllers

---
## Purpose

All controllers for the website are stored here.

As hierarchical MVC design pattern is used for pages rendering sub-directories will contain other sub-controllers.
See "Routing" framework branch for more details.

Remarks: do not forget to respect your name convention, otherwise controllers files may be unusable or double-access (and duplicate content is bad !)

---
## Access

Public access from web disallowed by htaccess.

---
## Remarks

Controllers in the root directory MUST be fronts controllers.
Sub-controllers must be stored in sub-directories with self-explaining names.