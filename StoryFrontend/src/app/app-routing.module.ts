import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './pages/login/login.component';
import { StoryDetailComponent } from './pages/components/story-detail/story-detail.component';
import { StoryCreateComponent } from './pages/components/story-create/story-create.component';
import { MainLayoutsComponent } from './pages/layouts/main-layouts/main-layouts.component';
import { StoryListComponent } from './pages/components/story-list/story-list.component';
import { PageConfigComponent } from './pages/components/page-config/page-config.component';
import { StoryConfigComponent } from './pages/components/story-config/story-config.component';

const routes: Routes = [
  {
    path: '',
    redirectTo: '/dashboard',
    pathMatch: 'full'
  },

  {
    path: '',
    component: MainLayoutsComponent,
    children: [
      {path: 'dashboard', component: StoryListComponent},
      {path: 'story/detail/:id', component: StoryDetailComponent},
      {path: 'story/create', component: StoryCreateComponent},
      {path: 'story/configPage/:id', component: PageConfigComponent},
      {path: 'story/config', component: StoryConfigComponent},
    ]
  },

  { path: 'login', component: LoginComponent },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
