"""Any custom behaviour of the User app."""

from django.apps import AppConfig


class UsersConfig(AppConfig):
    """The config of the CustomUser app."""

    default_auto_field = "django.db.models.BigAutoField"
    name = "users"
