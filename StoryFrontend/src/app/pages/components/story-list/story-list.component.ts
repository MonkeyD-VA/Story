import { Component } from '@angular/core';
import { stories } from '../../story';

@Component({
  selector: 'app-story-list',
  templateUrl: './story-list.component.html',
  styleUrls: ['./story-list.component.css']
})
export class StoryListComponent {
  stories = [...stories];

}
