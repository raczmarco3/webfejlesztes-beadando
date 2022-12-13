import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Message } from '../model/message';
import { Actor } from '../model/actor';

@Injectable({
    providedIn: 'root'
})
export class ActorService 
{
    private baseUrl = 'http://localhost:8000/api/';

    constructor(private http: HttpClient) { }

    getAllActor()
    {
        return this.http.get<Actor[]>(`${this.baseUrl}`+'actors');
    }

    addActor(jsonContent: JSON)
    {
        return this.http.post<Message>(`${this.baseUrl}`+'actor', jsonContent);
    }

    deleteActor(id: number)
    {
        return this.http.delete<Message>(`${this.baseUrl}`+'actor/'+id);
    }

    getActor(id: number)
    {
        return this.http.get<Actor>(`${this.baseUrl}`+'actor/'+id);
    }

    editActor(id: number, jsonContent: JSON)
    {
        return this.http.put<Message>(`${this.baseUrl}`+'actor/'+id, jsonContent);
    }
}