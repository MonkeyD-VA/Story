import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Constants } from '../../config/constants';

@Injectable({
  providedIn: 'root'
})
export class StoryService {

  constructor(
    private http: HttpClient
  ) { }

  private url = Constants.API_ENDPOINT + 'story';

  getStories(page: number): Observable<any> {
    const url = `${this.url}?page=${page}`;    
    return this.http.get<any>(this.url, Constants.options);
  }

  getStoryById(id: number): Observable<any> {
    const url = `${this.url}/detail/${id}`;
    
    return this.http.get<any>(url, Constants.options);
  }

  getPageOfStory(id: number): Observable<any> {
    const url = `${this.url}/pageOf/${id}`;
    return this.http.get<any>(url, Constants.options);
  }

  updateStory(id: number, storyData: any): Observable<any> {
    const url = `${this.url}/update/${id}`;
    return this.http.patch(url, storyData, Constants.options);
  }

  deleteStory(id: number): Observable<any> {
    const url = `${this.url}/delete/${id}`;
    return this.http.delete(url, Constants.options);
  }
}
