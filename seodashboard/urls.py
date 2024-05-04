# pylint: disable=too-few-public-methods, too-many-ancestors
"""
URL configuration for seodashboard project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/4.2/topics/http/urls/

Examples
--------
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))

"""

from django.contrib import admin
from django.urls import include, path
from rest_framework import routers, serializers, viewsets

from users.models import CustomUser


class UserSerializer(serializers.HyperlinkedModelSerializer):
    """Serializer for the User model."""

    class Meta:
        """The Meta class of the UserSerializer."""

        model = CustomUser
        fields = ["url", "email", "is_staff"]


class UserViewSet(viewsets.ModelViewSet):
    """View set for Users."""

    queryset = CustomUser.objects.all()
    serializer_class = UserSerializer


# Routers provide an easy way of automatically determining the URL conf.
router = routers.DefaultRouter()
router.register(r"users", UserViewSet)

urlpatterns = [
    path("admin/", admin.site.urls),
    path("api-auth/", include("rest_framework.urls")),
]
