"""To make the admin page of the users model work."""

from django.contrib import admin

from users.models import CustomUser

admin.site.register(CustomUser, admin.ModelAdmin)
