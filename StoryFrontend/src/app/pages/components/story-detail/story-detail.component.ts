import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Story, stories } from '../../story';

@Component({
  selector: 'app-story-detail',
  templateUrl: './story-detail.component.html',
  styleUrls: ['./story-detail.component.css']
})
export class StoryDetailComponent {
  story: Story | undefined;

  constructor(
    private route: ActivatedRoute
  ){}

  ngOnInit() {
    //get the story id from current route
    const routeParams = this.route.snapshot.paramMap;
    const storyIdFromRoute = Number(routeParams.get('id'));

    //find the story that correspond with the id in route
    this.story = stories.find(story => story.id === storyIdFromRoute);

  }


}
