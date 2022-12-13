import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Movie } from '../model/movie';
import { Actor } from '../model/actor';

@Injectable({
    providedIn: 'root'
})

export class ListRegistryService 
{
    private baseUrl = 'http://localhost:8000/api/';

    constructor(private http: HttpClient) { }

    listActors(movieId: number)
    {
        return this.http.get<Actor[]>(`${this.baseUrl}`+'movie/'+movieId+"/actors");
    }

    listMovies(actorId: number)
    {
        return this.http.get<Movie[]>(`${this.baseUrl}`+'actor/'+actorId+"/movies");
    }
}