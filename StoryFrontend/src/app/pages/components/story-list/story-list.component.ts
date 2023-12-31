import { AfterViewInit, Component, ViewChild, OnInit } from '@angular/core';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { StoryService } from 'src/app/core/services/componentServices/story.service';

@Component({
  selector: 'app-story-list',
  templateUrl: './story-list.component.html',
  styleUrls: ['./story-list.component.css'],
})
export class StoryListComponent implements AfterViewInit, OnInit {
  displayedColumns: string[] = [
    'id',
    'thumb',
    'name',
    'author',
    'authorId',
    'category',
    'actions',
  ];
  isLoading = false;
  totalRows = 0;
  pageSize = 5;
  currentPage = 0;

  dataSource = new MatTableDataSource<any>();

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private service: StoryService) {}

  ngAfterViewInit() {
    this.dataSource.paginator = this.paginator;
    this.dataSource.sort = this.sort;
  }

  ngOnInit(): void {
    // this.service.getStories().subscribe((response) => {
    //   console.log('log', response.data);

    //   this.dataSource.data = response.data.data;

    // });
    this.fetchData();
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();

    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }

  pageChanged(event: PageEvent) {
    console.log('ev', event);

    this.currentPage = event.pageIndex; // Update the current page

    this.fetchData();
  }

  fetchData() {
    this.isLoading = true;

    // Make an API request with the current page and page size
    this.service.getStories(this.currentPage).subscribe((response) => {
      this.isLoading = false;
      this.totalRows = response.data.total;
      this.dataSource.data = response.data.data;
      console.log('log', response.data);
    });
  }

  deleteStory(id: number) {
    this.service.deleteStory(id).subscribe({
      next: () => {
        console.log(`Story with ID ${id} has been deleted successfully.`);
        this.fetchData();
      },
      error: (error) => {
        console.error(`Error deleting story with ID ${id}:`, error);
      },
    });
  }
}
