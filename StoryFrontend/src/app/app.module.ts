import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './pages/login/login.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ReactiveFormsModule } from '@angular/forms';
import { StoryListComponent } from './pages/components/story-list/story-list.component';

import { MaterialModule } from './material.module';
import { StoryDetailComponent } from './pages/components/story-detail/story-detail.component';
import { StoryCreateComponent } from './pages/components/story-create/story-create.component';
import { SidebarComponent } from './pages/layouts/sidebar/sidebar.component';
import { HeaderComponent } from './pages/layouts/header/header.component';
import { FooterComponent } from './pages/layouts/footer/footer.component';
import { MainLayoutsComponent } from './pages/layouts/main-layouts/main-layouts.component';


@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    StoryListComponent,
    StoryDetailComponent,
    StoryCreateComponent,
    SidebarComponent,
    HeaderComponent,
    FooterComponent,
    MainLayoutsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    ReactiveFormsModule,
    MaterialModule,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
