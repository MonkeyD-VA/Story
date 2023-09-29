import { HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
@Injectable()
export class Constants {
  public static API_ENDPOINT: string = 'http://127.0.0.1:8000/api/';
  // public readonly API_MOCK_ENDPOINT: string = 'https://www.userdomainmock.com/';
  public static TitleOfSite: string = ' Making API calls the Right Way';

  // public static authToken: string ='Bearer ' + localStorage.getItem('token');
  public static authToken = localStorage.getItem('token');

  // Create headers with the authorization token
  public static headers = new HttpHeaders({
    Authorization: `Bearer ${Constants.authToken}`,
  });

  // Add the headers to the request
  public static options = { headers: Constants.headers };
}
