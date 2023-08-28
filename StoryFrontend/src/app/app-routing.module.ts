import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './pages/login/login.component';
import { HomeComponent } from './pages/home/home.component';
import { StoryDetailComponent } from './pages/components/story-detail/story-detail.component';
import { StoryCreateComponent } from './pages/components/story-create/story-create.component';

const routes: Routes = [
  {path: 'login', component: LoginComponent},
  {path: 'story/create', component: StoryCreateComponent},
  {path: 'story/:id', component: StoryDetailComponent},
  {path: '', component: HomeComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
