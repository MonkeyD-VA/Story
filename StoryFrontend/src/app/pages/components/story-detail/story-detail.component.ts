import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Story, stories } from '../../story';
import { Location } from '@angular/common';
import { StoryService } from 'src/app/core/services/componentServices/story.service';
import { PageService } from 'src/app/core/services/componentServices/page.service';
import { MatTableDataSource } from '@angular/material/table';

@Component({
  selector: 'app-story-detail',
  templateUrl: './story-detail.component.html',
  styleUrls: ['./story-detail.component.css']
})
export class StoryDetailComponent {
  story: any | undefined;
  pages: any | undefined;

  displayedColumns: string[] = ['number', 'content', 'background', 'config'];
  dataSource = new MatTableDataSource<any>();

  constructor(
    private route: ActivatedRoute,
    private storyService: StoryService,
    private location: Location,
    private pageService: PageService
  ) { }

  ngOnInit() {

    //get the story id from current route
    const routeParams = this.route.snapshot.paramMap;
    const storyIdFromRoute = Number(routeParams.get('id'));
    
    this.storyService.getStoryById(storyIdFromRoute).subscribe((response) => {
      this.story = response.data;
      
    });

    this.pageService.getPages().subscribe((response) => {      
      this.pages = response.data.data;

      this.pages.sort((a: any, b: any) => a.page_number - b.page_number);      
      this.dataSource.data = this.pages;

    });
  }

  goBack(): void {
    this.location.back();
  }
}
