"""Anything related to seo dashboard views."""

from django.shortcuts import render


def index(request):  # noqa: V103
    """Build the home page."""
    return render(request, "index.html")
