import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Story, stories } from '../../story';
import { ConfigService } from 'src/app/config/config.service';
import { Location } from '@angular/common';

@Component({
  selector: 'app-story-detail',
  templateUrl: './story-detail.component.html',
  styleUrls: ['./story-detail.component.css']
})
export class StoryDetailComponent {
  story: any | undefined;
  stories: any | undefined;
  constructor(
    private route: ActivatedRoute,
    private config: ConfigService,
    private location: Location
  ){}

  ngOnInit() {

    this.config.getStories().subscribe((response) => {
      this.stories = response.stories;

      //get the story id from current route
      const routeParams = this.route.snapshot.paramMap;
      const storyIdFromRoute = Number(routeParams.get('id'));

      //find the story that correspond with the id in route
      this.story = this.stories.find((story:any) => story.story_id === storyIdFromRoute);
    });
  }

  goBack(): void {
    this.location.back();
  }
}
