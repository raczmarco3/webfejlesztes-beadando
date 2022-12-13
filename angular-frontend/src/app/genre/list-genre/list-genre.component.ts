import { Component } from '@angular/core';
import { Genre } from '../../model/genre';
import { GenreService } from '../../service/genre-service';

@Component({
  selector: 'app-list-genre',
  templateUrl: './list-genre.component.html',
  styleUrls: ['./list-genre.component.css']
})
export class ListGenreComponent 
{  
  genres: Genre[] = [];
  isFetching: boolean;
  msg: any;

  constructor(private genreService:GenreService) { }

  ngOnInit() {
    this.isFetching = true;
    this.genreService.getAllGenre().subscribe(
      {
        next: (respone) => {
          this.genres = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }
}
