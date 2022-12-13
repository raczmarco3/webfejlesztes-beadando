import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Genre } from '../model/genre';
import { Message } from '../model/message';

@Injectable({
    providedIn: 'root'
})

export class GenreService 
{
    private baseUrl = 'http://localhost:8000/api/';

    constructor(private http: HttpClient) { }

    getAllGenre()
    {
        return this.http.get<Genre[]>(`${this.baseUrl}`+'genres');
    }

    deleteGenre(id: number)
    {
        return this.http.delete<Message>(`${this.baseUrl}`+'genre/'+id);
    }

    addGenre(jsonContent: JSON)
    {
        return this.http.post<Message>(`${this.baseUrl}`+'genre', jsonContent);
    }

    getGenre(id: number)
    {
        return this.http.get<Genre>(`${this.baseUrl}`+'genre/'+id);
    }

    editGenre(id: number, jsonContent: JSON)
    {
        return this.http.put<Message>(`${this.baseUrl}`+'genre/'+id, jsonContent);
    }
}