import { Component } from '@angular/core';
import { MovieService } from 'src/app/service/movie-service';
import { GenreService } from 'src/app/service/genre-service';
import { Genre } from 'src/app/model/genre';
import { FormControl, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-new-movie',
  templateUrl: './new-movie.component.html',
  styleUrls: ['./new-movie.component.css']
})
export class NewMovieComponent {

  constructor(private movieService:MovieService, private genreService:GenreService) {}

  jsonContent: JSON;
  obj: any;
  msg: any;
  processing: boolean = true;
  genres: Genre[] = [];

  addMovieForm = new FormGroup({
    title:new FormControl(),
    genre: new FormControl(),
    length: new FormControl(),
    releaseYear: new FormControl()
  });

  ngOnInit() {
    this.genreService.getAllGenre().subscribe(
      {
        next: (respone) => {
          this.genres = respone;    
          this.processing = false;      
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    );  
  }

  onSubmit() {    
    this.obj = {
      "title": this.addMovieForm.get('title')?.value,
      "genreId": this.addMovieForm.get('genre')?.value,
      "length": this.addMovieForm.get('length')?.value,
      "releaseYear": this.addMovieForm.get('releaseYear')?.value
    }
    this.jsonContent = <JSON>this.obj;

    this.processing = true;
    this.movieService.addMovie(this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    )
  }

}
